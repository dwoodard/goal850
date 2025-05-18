<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdentityProtectController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('IdentityProtect');
    }
}
