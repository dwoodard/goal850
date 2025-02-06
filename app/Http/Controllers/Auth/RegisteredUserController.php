<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'billingAddress' => 'required|string|max:255',
            'contractAccepted' => 'required|boolean',
        ]);
        
        $user = User::create($request->all());

        // Create a pipeline to handle additional tasks
        app(Pipeline::class)
            ->send($user)
            ->through([
                \App\Pipes\CreateSquareUser::class,
                // \App\Pipes\CreateGoHighLevelUser::class,
                // \App\Pipes\CreateArrayUser::class,

            ])
            ->then(function ($user) {
                return $user;
            });

        // (new App\Http\Controllers\Auth\UserRegistrationService)->handle($user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
