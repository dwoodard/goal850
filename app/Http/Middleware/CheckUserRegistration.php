<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckUserRegistration
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // 🚧 Not logged in? Go to login
        if (! $user) {
            return Redirect::route('login');
        }

        // 🚧 Get active subscription
        $subscription = $user->subscriptions('default')->active()->first();

        if (! $subscription) {
            return Redirect::route('billing');
        }

        // 🚧 Hasn't completed registration wizard
        if (! $user->hasCompletedRegistration()) {
            return Redirect::route('registration.wizard');
        }

        return $next($request);
    }
}
