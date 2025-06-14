<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle the incoming Stripe webhook.
     */
    public function handle(WebhookReceived $event): void
    {
        $payload = $event->payload;
        $type = $payload['type'] ?? null;

        match ($type) {
            'customer.created' => $this->handleCustomerCreated($payload),
            'checkout.session.completed' => $this->handleCheckoutSessionCompleted($payload),
            default => null,
        };
    }

    /**
     * Update user with Stripe customer ID on customer.created
     */
    protected function handleCustomerCreated(array $payload): void
    {
        try {
            $customerData = $payload['data']['object'];
            $email = $customerData['email'];
            $stripeId = $customerData['id'];

            $user = User::where('email', $email)->update([
                'stripe_id' => $stripeId,
            ]);
        } catch (\Exception $e) {
            Log::error('Error processing customer.created', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Enroll user in Array products after checkout
     */
    protected function handleCheckoutSessionCompleted(array $payload): void
    {
        try {
            $session = $payload['data']['object'];
            $email = $session['customer_email'] ?? null;
            $user = $email ? User::where('email', $email)->first() : null;

            // log out these things
            Log::info('Checkout session completed', [
                'email' => $email,
                'user_id' => $user->id ?? null,
                'session_id' => $session['id'] ?? null,
            ]);

            if (! $user) {
                Log::warning('User not found for Stripe customer_email', compact('email'));

                return;
            }

            if ($user->hasCompletedStripe()) {
                $user->enrollInArrayProducts();
            }
        } catch (\Exception $e) {
            Log::error('Error processing checkout.session.completed', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
