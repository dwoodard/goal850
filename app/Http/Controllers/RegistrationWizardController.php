<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class RegistrationWizardController extends Controller
{
    public function user()
    {

        // Get the authenticated user
        $user = auth()->user();

        $data = [
            'user' => $user,
        ];

        // Return the Inertia view for the Registration Wizard
        return Inertia::render('RegistrationWizard/user', $data);
    }

    // KBA step
    public function kba(Request $request)
    {
        $user = auth()->user();
        $data = [
            'user' => $user,
        ];

        // Return the Inertia view for the KBA step
        return Inertia::render('RegistrationWizard/kba', $data);
    }

    // user store
    public function userStore(RegistrationRequest $request)
    {

        $data = $request->validated();

        $user = auth()->user();

        // Use the request data directly instead of saving to the user model
        $response = $this->createArrayUser(
            $user,
            $data['dob'],
            $data['ssn']
        );

        if (! $response->successful()) {
            return Inertia::render('RegistrationWizard/user', [
                'errors' => ['api_error' => 'Failed to create Array user. Please try again.'],
                'user' => $user,
            ]);
        }

        $user->array_user_id = $response->json('userId');
        $user->save();

        $user->refresh();

        return redirect()->route('dashboard');
    }

    // kbaStore
    public function kbaStore(Request $request)
    {
        $request->validate([
            'user-token' => 'required',
        ]);

        $userToken = $request->input('user-token');
        auth()->user()->update([
            'array_user_token' => $userToken,
        ]);

        return redirect()->route('dashboard');
    }

    // createArrayUser function
    private function createArrayUser($user, $dob, $ssn)
    {

        $arrayUrl = config('array.api_url');

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post($arrayUrl.'/api/user/v2', [
            'appKey' => env('ARRAY_APP_KEY'),
            'dob' => $dob,
            'ssn' => $ssn,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'emailAddress' => $user->email,
            'phoneNumber' => $user->phone,
        ]);

        return $response;
    }
}
