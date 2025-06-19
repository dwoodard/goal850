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
            // Customer events
            'customer.created' => $this->handleCustomerCreated($payload),

            // Subscription lifecycle events
            'customer.subscription.created' => $this->handleArrayEnrollment($payload),
            // 'customer.subscription.updated' => $this->handleArrayEnrollment($payload),

            // Checkout events (for new subscriptions)
            // 'checkout.session.completed' => $this->handleCheckoutCompleted($payload),

            // default => Log::info("{$type} Stripe webhook event"),
            default => null
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

            dump(
                'Stripe customer created for user',
            );
        } catch (\Exception $e) {
            Log::error('Error processing customer.created', [
                'error' => $e->getMessage(),
                'payload' => $payload,
            ]);
        }
    }

    protected function handleArrayEnrollment(array $payload): void
    {
        $customerId = $payload['data']['object']['customer'];
        $user = User::where('stripe_id', $customerId)->first();

        try {
            $user->enrollInArrayProducts();
        } catch (\Exception $e) {
            dump(
                'Error enrolling user in Array products',
                $e->getMessage(),
                $payload,
                $user
            );

        }
    }

    protected function handleCheckoutCompleted(array $payload): void {}
}
