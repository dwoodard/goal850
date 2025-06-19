<?php

use Illuminate\Support\Facades\Route;

if (app()->environment('local')) {
    Route::get('/debug/info', function () {
        return [
            'app' => config('app.name'),
            'environment' => app()->environment(),
            'debug' => config('app.debug'),
        ];
    });

    Route::get('/debug/stripe', function () {

        // Set the Stripe API key using Cashier's configuration
        \Stripe\Stripe::setApiKey(config('cashier.secret'));

        try {
            $products = \Stripe\Product::all(['active' => true]);

            return [
                'success' => true,
                'count' => count($products->data),
                'products' => $products->data,
                'stripe_config' => config('stripe'),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'config_check' => [
                    'stripe_secret_configured' => ! empty(config('cashier.secret')),
                    'stripe_key_configured' => ! empty(config('cashier.key')),
                ],
            ];
        }
    });

    Route::get('/debug/user-plan', function () {

        // get the auth user
        $user = auth()->user();

        $user->enrollInArrayProducts();

        try {
            // Set the Stripe API key using Cashier's configuration
            \Stripe\Stripe::setApiKey(config('cashier.secret'));

            // Check what users we have

            if (! $user) {
                // Let's create a test stripe customer for the first user
                $firstUser = \App\Models\User::first();

                if ($firstUser && ! $firstUser->stripe_id) {
                    // Create a Stripe customer for testing
                    $customer = \Stripe\Customer::create([
                        'email' => $firstUser->email,
                        'name' => trim($firstUser->first_name.' '.$firstUser->last_name),
                        'metadata' => [
                            'user_id' => $firstUser->id,
                        ],
                    ]);

                    // Update the user with the stripe_id
                    $firstUser->update(['stripe_id' => $customer->id]);

                    dd([
                        'user' => $firstUser,
                        'action' => 'Created Stripe customer for testing',
                        'user_id' => $firstUser->id,
                        'user_email' => $firstUser->email,
                        'stripe_id' => $customer->id,

                        'next_step' => 'Now visit this route again to test the plans() method',
                    ]);
                }

                return [
                    'success' => false,
                    'error' => 'No users found and could not create test user',

                ];
            }

            // Test the plans() method with a user that has stripe_id
            dd(collect([
                'user' => $user,
                'user_id' => $user->id,
                'user_email' => $user->email,
                'stripe_id' => $user->stripe_id,
                'plans_method_result' => $user->plans()->get(),
                'stripeProductIds' => $user->stripeProductIds(),
                'subscriptions_count' => $user->subscriptions()->count(),
                'subscriptions_raw' => $user->subscriptions()->get(),

            ]));

            // Get the first user with a stripe_id
            $user = \App\Models\User::whereNotNull('stripe_id')->first();

            if (! $user) {
                return [
                    'success' => false,
                    'error' => 'No users found with stripe_id',
                ];
            }

            // Test the plan() method (corrected from plans() to plan())
            $planData = $user->plans();

            return [
                'success' => true,
                'user_id' => $user->id,
                'user_email' => $user->email,
                'plan_data' => $planData,
                'all_subscriptions' => $user->subscriptions()->get()->map(function ($subscription) {
                    return [
                        'id' => $subscription->id,
                        'stripe_id' => $subscription->stripe_id,
                        'stripe_status' => $subscription->stripe_status,
                        'stripe_plan' => $subscription->stripe_plan,
                        'stripe_price' => $subscription->stripe_price,
                        'quantity' => $subscription->quantity,
                        'trial_ends_at' => $subscription->trial_ends_at,
                        'ends_at' => $subscription->ends_at,
                        'created_at' => $subscription->created_at,
                        'updated_at' => $subscription->updated_at,
                    ];
                }),
                'has_stripe_id' => ! empty($user->stripe_id),
                'stripe_id' => $user->stripe_id,
                'subscription_methods' => [
                    'subscribed_default' => $user->subscribed(),
                    'has_completed_stripe' => $user->hasCompletedStripe(),
                ],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ];
        }
    });

    Route::get('/debug/user-array-products', function () {
        // userId
        $userId = auth()->user()->array_user_id;
        // config('array.api_token')

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'x-array-server-token' => config('array.api_token'),
        ])
            ->get(config('array.api_url')."/api/monitoring/v2?userId={$userId}");

        // dump out $response
        if ($response->failed()) {
            return [
                'success' => false,
                'error' => $response->body(),
                'status' => $response->status(),
            ];
        }

        return [
            'success' => true,
            'data' => $response->json(),
        ];
    });
}
