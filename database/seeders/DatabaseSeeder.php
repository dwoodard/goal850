<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('asdfasdf'),
            'super' => true,
        ]);

        // Not subscribed user
        $user = User::factory()->create([
            'first_name' => 'User',
            'last_name' => 'NotSubscribed',
            'email' => 'user@notsubscribed.com',
            'password' => bcrypt('asdfasdf'),
            'super' => false,
        ]);

        // Subscribed user (Active)
        $user = User::factory()->create([
            'first_name' => 'User',
            'last_name' => 'isSubscribed',
            'email' => 'user@subscribed.com',
            'password' => bcrypt('asdfasdf'),
            'super' => false,
        ]);
        $user->createAsStripeCustomer([
            'email' => $user->email,
        ]);

        // Array Demo User
        $user = User::factory()->create([
            'first_name' => 'Donald',
            'last_name' => 'Blair',
            'phone' => '6660000001',
            'email' => 'dblair@example.com',
            'password' => bcrypt('asdfasdf'),
            'super' => false,
        ]);
        $user->createAsStripeCustomer([
            'email' => $user->email,
        ]);

        $user->newSubscription('prod_S2W1o3GAej7brB', 'price_1R9EpDHIAHd68JddloQlFrP0')
            ->trialDays(10)
            ->create('pm_card_visa', [
                'email' => $user->email,
            ]);

        $this->call(CollectionSeeder::class);
        $this->call(EntrySeeder::class);
    }
}
