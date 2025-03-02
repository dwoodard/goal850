<?php

namespace App\Console\Commands;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Stripe\StripeClient;

class ClearDemoUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:clear-demo 
        {--stripe-id= : Specific Stripe ID to clear}
        {--ghl-id= : Specific Go High Level ID to clear}
        {--all : Clear all demo users}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear demo users from database, Stripe, and GoHighLevel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // if this is production, don't run this command
        if (app()->environment('production')) {
            $this->error('This command cannot be run in production.');

            return 1;
        }

        // Initialize services
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $httpClient = new Client;

        // Determine which users to clear
        $query = User::query();

        if ($this->option('stripe-id')) {
            $query->where('stripe_id', $this->option('stripe-id'));
        } elseif ($this->option('ghl-id')) {
            $query->where('ghl_user_id', $this->option('ghl-id'));
        } elseif ($this->option('all')) {
            // You might want to add specific conditions for what constitutes a "demo" user
            // For example: $query->where('is_demo', true);
            // For now, we'll assume you have some way to identify demo users
            $query->whereNotNull('stripe_id')->orWhereNotNull('ghl_user_id');
        } else {
            $this->error('Please specify either --stripe-id, --ghl-id, or --all');

            return 1;
        }

        $users = $query->get();

        if ($users->isEmpty()) {
            $this->info('No matching users found.');

            return 0;
        }

        $this->info("Found {$users->count()} users to clear.");

        foreach ($users as $user) {
            $this->info("Processing user: {$user->email}");

            try {
                // Clear from Stripe
                if ($user->stripe_id) {
                    try {
                        $stripe->customers->delete($user->stripe_id);
                        $this->info("✓ Cleared from Stripe: {$user->stripe_id}");
                    } catch (\Exception $e) {
                        $this->warn("Failed to clear from Stripe: {$e->getMessage()}");
                    }
                }

                // Clear from GoHighLevel
                if ($user->ghl_user_id) {
                    try {
                        $httpClient->delete(
                            "https://rest.gohighlevel.com/v1/contacts/{$user->ghl_user_id}",
                            [
                                'headers' => [
                                    'Authorization' => 'Bearer '.env('GHL_API_TOKEN'),
                                    'Content-Type' => 'application/json',
                                ],
                            ]
                        );
                        $this->info("✓ Cleared from GHL: {$user->ghl_user_id}");
                    } catch (\Exception $e) {
                        $this->warn("Failed to clear from GHL: {$e->getMessage()}");
                    }
                }

                // Delete the user from database
                $user->delete();
                $this->info('✓ Deleted user from database');

            } catch (\Exception $e) {
                $this->error("Error processing user {$user->email}: {$e->getMessage()}");

                continue;
            }
        }

        $this->info('Demo user cleanup completed!');

        return 0;
    }
}
