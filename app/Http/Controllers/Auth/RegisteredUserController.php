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

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'billingAddress' => 'required|string|max:255',
            'contractAccepted' => 'required|boolean',
        ]);

        $user = User::create($request->all());
        $user->createAsStripeCustomer();
        $user->createGoHighLevelUser();

        // (new App\Http\Controllers\Auth\UserRegistrationService)->handle($user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Create a contact in Go HighLevel.
     */
    protected function createGoHighLevelContact($user)
    {
        $client = new \GuzzleHttp\Client;
        $apiKey = env('GOHIGHLEVEL_API_TOKEN'); // Ensure this is in your .env

        $response = $client->post('https://rest.gohighlevel.com/v1/contacts/', [
            'headers' => [
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'phone' => $user->phone_number,
                'source' => 'Laravel Registration',
            ],
        ]);

        // Store GHL contact ID for later updates
        $ghlData = json_decode($response->getBody(), true);
        $user->update(['ghl_contact_id' => $ghlData['contact']['id']]);
    }
}
