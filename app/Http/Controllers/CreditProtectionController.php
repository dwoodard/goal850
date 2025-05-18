<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditProtectionController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('CreditProtection');
    }
}
