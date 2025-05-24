<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // List all users
    }

    public function show($id)
    {
        // Show a single user
    }

    public function store(Request $request)
    {
        // Create a new user
    }

    public function update(Request $request, $id)
    {
        // Update an existing user
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy($id)
    {
        // Delete a user
    }
}
