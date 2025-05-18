<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditScoreDetailsController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('CreditScoreDetails');
    }
}
