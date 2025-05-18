<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditScoreSimulatorController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('CreditScoreSimulator');
    }
}
