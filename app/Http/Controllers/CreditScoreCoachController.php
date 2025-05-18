<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditScoreCoachController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('CreditScoreCoach');
    }
}
