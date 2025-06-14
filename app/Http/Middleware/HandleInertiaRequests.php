<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = auth()->user();

        return [
            ...parent::share($request),

            'user' => $user ? array_merge($user
                ->only('id', 'first_name', 'last_name', 'email', 'phone', 'array_user_id', 'array_user_token'), [
                    'is_admin' => $user->is_admin,
                    'is_subscribed' => $user?->subscription('prod_S2W1o3GAej7brB')?->active(),
                    'array_user_token' => $user->array_user_token,
                ])
            : null,

            'array' => [
                'appKey' => config('array.app_key'),
                'apiUrl' => config('array.api_url'),
                'apiComponentUrl' => config('array.api_component_url'),
                'sandbox' => env('ARRAY_SANDBOX', app()->isLocal()),
            ],

            'stripe' => [
                'publishableKey' => config('stripe.publishable_key'),
                'pricingTableId' => config('stripe.pricing_table_id'),
                'plans' => config('stripe.plans'),
            ],

            'appEnv' => app()->environment(),
        ];
    }
}
