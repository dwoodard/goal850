<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        // Check if this is a customer.created event
        if ($event->payload['type'] === 'customer.created') {
            try {
                // Get the customer data from the webhook payload
                $customerData = $event->payload['data']['object'];
                $stripeEmail = $customerData['email'];
                $stripeId = $customerData['id'];

                // Find the user with matching email
                $user = \App\Models\User::where('email', $stripeEmail)
                    ->update([
                        'stripe_id' => $stripeId,
                    ]);

            } catch (\Exception $e) {
                Log::error('Error processing customer.created webhook', [
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
