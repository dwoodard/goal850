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
}
