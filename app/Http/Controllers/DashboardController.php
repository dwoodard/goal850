<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        return inertia()->render('Dashboard', [
            'can_privacy_scan' => $user->canPrivacyScan(),
        ]);
    }
}
