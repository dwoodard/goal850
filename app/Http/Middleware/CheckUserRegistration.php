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
        // dd($user); // Does the user object look correct?

        try {
            if (! $user->hasCompletedStripe()) {
                return Inertia::render('RegistrationWizard');
            }
        } catch (\Throwable $e) {
            // ... (error handling) ...
            return Inertia::render('Billing', [
                'error' => 'Could not verify registration status. Please check your subscription.',
            ]);
        }

        $activeSubscription = $user->findActiveDefaultSubscription();

        if (! $activeSubscription) {
            Log::debug("CheckUserRegistration: User {$user->id} does not have an active default subscription, redirecting to billing.");

            // Ensure the billing route exists
            return Redirect::route('billing');
        }

        // 🚧 Hasn't completed registration wizard
        if (! $user->hasCompletedRegistration()) {
            return Redirect::route('registration.wizard');
        }

        return $next($request);
    }
}
