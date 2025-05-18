<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditScoreController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('CreditScore');
    }
}
