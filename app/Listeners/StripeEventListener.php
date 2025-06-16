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
            'customer.subscription.created' => $this->handleSubscriptionCreated($payload),
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

            dump(
                'Stripe customer created for user',
            );
        } catch (\Exception $e) {
            Log::error('Error processing customer.created', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Enroll user in Array products after subscription created
     * This is triggered by the checkout.session.completed event.
     *
     * @see https://stripe.com/docs/api/events/types#event_types-checkout.session.completed
     */
    protected function handleSubscriptionCreated(array $payload): void
    {

        try {
            $session = $payload['data']['object'];
            // get $user by customer ("customer" => "cus_SVNuykC16SHBW4")
            $user = User::where('stripe_id', $session['customer'])->first();

        } catch (\Exception $e) {
            Log::error('Error processing checkout.session.completed', [
                'error' => $e->getMessage(),
            ]);
        }

        $user->enrollInArrayProducts();
    }
}
