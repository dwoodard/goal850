<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditDebtAnalysisController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('CreditDebtAnalysis');
    }
}
