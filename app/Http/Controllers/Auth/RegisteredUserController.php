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
            'phone_number' => 'required|numeric|unique:'.User::class.',phone_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $request->validate([
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     // 'billingAddress' => 'required|string|max:255',
        //     // 'contractAccepted' => 'required|boolean',
        // ]);

        $user = User::create($request->all());

        // https://www.youtube.com/watch?v=2_BsWO5WRmU&t=889s
        $user->registerAsStripeCustomer();

        // $user->createAsStripeCustomer();
        // $user->createGoHighLevelUser();

        // (new App\Http\Controllers\Auth\UserRegistrationService)->handle($user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /*
        register as stripe customer
        */
    public function registerAsStripeCustomer($user): void
    {
        $user
            ->newSubscription('prod_RrgBQhJGRJHOxf', ['price_1QxwoiHIAHd68JddyMYe9yaI'])
            ->trialDays(5)
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
        $apiKey = env('GOHIGHLEVEL_API_TOKEN');

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
