<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PipScanController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('PipScan');
    }
}
