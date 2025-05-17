<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        if (request()->query('intent')) {
            session(['intent' => request()->query('intent')]);
        }

        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        $request->merge([
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
            'email' => strtolower($request->email),
        ]);

        $data = $request->validate([
            'phone' => 'required|numeric|digits:10|unique:'.User::class.',phone',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'newsletter' => 'boolean',
        ]);

        // check validation for errors
        if (! $data) {
            // return error response
            return Inertia::render('Auth/Register', [
                'errors' => $request->errors(),
                'status' => 'Registration failed! Please try again.',
            ]);
        }

        $user = User::create($data);
        Auth::login($user);
        $this->createGoHighLevelContact($user);

        event(new Registered($user));

        if (session('intent') === 'privacy.scan') {
            return redirect()->route('privacy.scan');
        }

        // Redirect back to the register page with props for the pricing table
        return Inertia::render('Auth/Register', [
            'showPricingTable' => true,
            'userEmail' => $user->email,
            'userId' => $user->id,
            'status' => 'Registration successful! Please select a plan.',
        ]);

    }

    protected function createGoHighLevelContact($user)
    {
        $client = new \GuzzleHttp\Client;

        if (env('GHL_ENABLED')) {
            $response = $client->post('https://rest.gohighlevel.com/v1/contacts/', [
                'headers' => [
                    'Authorization' => 'Bearer '.env('GHL_API_TOKEN'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'firstName' => $user->first_name,
                    'lastName' => $user->last_name,
                    'source' => 'Goal850 Registration',
                    'tags' => ['goal850'],
                    'customFields' => [
                        'goal850_id' => $user->id,
                    ],
                ],
            ]);

            // Store GHL contact ID for later updates
            $ghlData = json_decode($response->getBody(), true);
            $user->update([
                'ghl_contact_id' => $ghlData['contact']['id'],
                'ghl_location_id' => $ghlData['contact']['locationId'],
            ]);
        }
    }
}
