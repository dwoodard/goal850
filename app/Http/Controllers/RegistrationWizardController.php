<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class RegistrationWizardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        $data = [
            'user' => $user,
        ];

        // Return the Inertia view for the Registration Wizard
        return inertia('RegistrationWizard/index', $data);
    }

    // store
    public function store(RegistrationRequest $request)
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
            return response()->json([
                'error' => 'Failed to create Array user',
                'message' => $response->json('message'),
            ], 500);
        }

        $user->array_user_id = $response->json('userId');
        $user->save();

        return Inertia::render('Dashboard', []);

    }

    // createArrayUser function
    private function createArrayUser($user, $dob, $ssn)
    {
        return Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post('https://sandbox.array.io/api/user/v2', [
            'appKey' => env('ARRAY_APP_KEY'),
            'dob' => $dob,
            'ssn' => $ssn,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'emailAddress' => $user->email,
            'phoneNumber' => $user->phone,
        ]);
    }
}
