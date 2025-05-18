<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentLoanNavigatorController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('StudentLoanNavigator');
    }
}
