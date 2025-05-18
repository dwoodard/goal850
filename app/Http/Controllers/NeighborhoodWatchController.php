<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NeighborhoodWatchController extends Controller
{
    public function index(Request $request)
    {
        return inertia()->render('NeighborhoodWatch');
    }
}
