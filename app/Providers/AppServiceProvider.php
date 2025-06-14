<?php

namespace App\Providers;

use App\Listeners\ArrayTokenRefresh;
use App\Listeners\StripeEventListener;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            StripeEventListener::class,
            ArrayTokenRefresh::class
        );

        Cashier::useCustomerModel(User::class);
        Vite::prefetch(concurrency: 3);
    }
}
