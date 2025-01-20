<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [
            'user' => auth()->user()->only('id', 'name', 'email', 'is_admin'),
        ];

        return inertia()->render('Dashboard', $data);
    }
}
