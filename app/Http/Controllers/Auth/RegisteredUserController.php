<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        // transform phone number to 10 digits
        $request->merge([
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
            'email' => strtolower($request->email),
        ]);

        $step = $request->input('step');

        if ($step === 0) {
            $data = $request->validate([
                'phone' => 'required|numeric|digits:10|unique:'.User::class.',phone',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create($data);

            event(new Registered($user));
            // redirect back

            return redirect()->back();

        } elseif ($step === 1) {
            $user = User::find($request->session()->get('registration'));
            dd(
                $user,
                $request->session()->get('registration'),
            );
            // https://www.youtube.com/watch?v=2_BsWO5WRmU&t=889s
            $this->registerAsStripeCustomer($user);
            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        }

        // redirect to the back to the same page (inertia)

        return redirect()->back();

    }

    /*
        register as stripe customer
        */
    public function registerAsStripeCustomer($user): void
    {
        $user
            ->newSubscription('prod_RrgBQhJGRJHOxf', ['price_1QxwoiHIAHd68JddyMYe9yaI'])
            ->trialDays(7)
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('welcome'),
            ]);
    }

    /**
     * Create a contact in Go HighLevel.
     */
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

                    // Custom fields
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
