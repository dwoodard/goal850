<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Square\SquareClient;

class SquareServiceProvider extends ServiceProvider
{
    /**
     * Register the Square client as a singleton in the service container.
     */
    public function register()
    {
        $this->app->singleton(SquareClient::class, function () {
            return new SquareClient([
                'accessToken' => env('SQUARE_ACCESS_TOKEN'),
                'environment' => env('SQUARE_ENVIRONMENT'),
            ]);
        });
    }

    public function boot()
    {
        // Optional boot logic or event registrations
    }
}
