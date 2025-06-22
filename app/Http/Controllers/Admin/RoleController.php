<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        // Add admin authorization check
        if (! auth()->user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        return inertia()->render('Admin/Roles', [
            'roles' => [],  // TODO: Implement role listing
        ]);
    }
}
