<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::select([
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'super as is_admin',
            'email_verified_at',
            'last_login',
            'login_count',
            'created_at',
            'updated_at',
        ])
            ->withCount('subscriptions')
            ->latest()
            ->paginate(15);

        return inertia()->render('Admin/Users', [
            'users' => $users,
        ]);
    }

    public function edit(User $user)
    {
        $user->load('subscriptions');
        $user->loadCount('subscriptions');

        // Add is_admin attribute for consistency
        $user->is_admin = $user->super;

        return inertia()->render('Admin/EditUser', [
            'editUser' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_admin' => ['boolean'],
        ]);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'super' => $validated['is_admin'] ?? false,
        ]);

        return redirect()->route('admin.users.index')
            ->with('message', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting the current user
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('message', 'User deleted successfully.');
    }

    public function verifyEmail(User $user)
    {
        $user->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->back()
            ->with('message', 'User email verified successfully.');
    }

    public function unverifyEmail(User $user)
    {
        $user->update([
            'email_verified_at' => null,
        ]);

        return redirect()->back()
            ->with('message', 'User email verification removed.');
    }

    public function setPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->back()
            ->with('message', "Password has been set successfully for {$user->first_name} {$user->last_name}.");
    }

    public function subscriptions(User $user)
    {
        $user->load('subscriptions');

        return inertia()->render('Admin/UserSubscriptions', [
            'editUser' => $user,
        ]);
    }
}
