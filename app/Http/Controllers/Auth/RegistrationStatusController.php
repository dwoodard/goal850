<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegistrationStatusController extends Controller
{
    // success
    public function success(Request $request)
    {
        return Inertia::render('Auth/RegisterSuccess', []);
    }

    // cancel
    public function cancel(Request $request)
    {
        return Inertia::render('Auth/RegisterCancel');
    }
}
