<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;

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

        $formName = $request->input('form_name');

        unset($request['form_name']);

        // Validate the request data based on the form name
        switch ($formName) {
            case 'array_dob_ssn':

                $data = $request->validate([
                    'dob' => [
                        'required',
                        'date_format:Y-m-d',
                        'date',
                    ],
                    'ssn' => [
                        'required',

                        'numeric',
                        'digits:9',
                    ],
                ]);

                // once validated, take this user and send the dob and ssn to the array api
                $user = auth()->user();

                // Use the request data directly instead of saving to the user model
                $response = $this->createArrayUser($user, $data['dob'], $data['ssn']);

                // the response should have the array_user_id
                // save it to the user

                if ($response->successful()) {
                    $user->array_user_id = $response->json('id');
                    $user->save();

                    // redirect to dashboard inertia render
                    return redirect()->route('dashboard');
                }

                break;

                // Add more cases for other forms as needed
            default:
                return response()->json(['error' => 'Invalid form name'], 400);
        }

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
