<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [
            'user' => auth()->user()->only(
                'id',
                'first_name',
                'last_name',
                'email',
                'is_admin', 
            ),
        ];

        return inertia()->render('Dashboard', $data);
    }
}
