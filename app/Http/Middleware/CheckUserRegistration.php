<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CheckUserRegistration
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\User|null $user */
        $user = $request->user();

        // 🚧 Not logged in? Go to login
        if (! $user) {
            return Redirect::route('login');
        }

        if (! $user->hasCompletedStripe()) {
            // 🚧 Not completed Stripe? Go to billing
            return Inertia::render('Billing/Index');
        }

        // 🚧 Hasn't completed Array user
        if (! $user->hasCompletedArrayUser()) {
            return Redirect::route('registration.wizard.user');
        }

        // 🚧 Hasn't completed Array KBA
        if (! $user->hasCompletedArrayUserToken()) {
            return Redirect::route('registration.wizard.kba');
        }

        return $next($request);
    }
}
