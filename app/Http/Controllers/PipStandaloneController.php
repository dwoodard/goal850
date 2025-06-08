<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PipStandaloneController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('PipStandalone');
    }
}
