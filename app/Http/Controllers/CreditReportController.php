<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class CreditReportController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('CreditReport');
    }
}
