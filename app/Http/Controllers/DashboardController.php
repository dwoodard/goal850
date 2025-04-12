<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $data = [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
                'is_subscribed' => $user?->subscription('prod_S2W1o3GAej7brB')?->active(),
                'stripe_status' => $user?->subscription('prod_S2W1o3GAej7brB')?->stripe_status,
                'is_on_trial' => $user?->subscription('prod_S2W1o3GAej7brB')?->onTrial(),
                'trial_ends_at' => $user?->subscription('prod_S2W1o3GAej7brB')?->trial_ends_at?->format('Y-m-d H:i:s'),

            ],

        ];

        return inertia()->render('Dashboard', $data);
    }
}
