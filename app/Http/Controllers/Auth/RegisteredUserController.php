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
use Stripe\Webhook;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
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

        $user = User::create($data);
        $this->createGoHighLevelContact($user);

        event(new Registered($user));

        // Redirect back to the register page with props for the pricing table
        return Inertia::render('Auth/Register', [
            'showPricingTable' => true,
            'userEmail' => $user->email,
            'userId' => $user->id,
            'status' => 'Registration successful! Please select a plan.',
        ]);

    }

    public function handleWebhook(Request $request)
    {

         

        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        
        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);

            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    $this->handleCheckoutSessionCompleted($session);
                    break;
                    // Add other event types as needed
            }

            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    protected function handleCheckoutSessionCompleted($session)
    {
        $user = User::where('email', $session->customer_email)->first();

        if ($user) {
            $user->update([
                'stripe_id' => $session->customer,
                'stripe_subscription_id' => $session->subscription,
            ]);

            $user->subscriptions()->create([
                'name' => 'default',
                'stripe_id' => $session->subscription,
                'stripe_status' => 'active',
                'stripe_price' => $session->display_items[0]->price->id,
                'quantity' => 1,
                'trial_ends_at' => now()->addDays(7),
            ]);
            Auth::login($user);
        }
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
