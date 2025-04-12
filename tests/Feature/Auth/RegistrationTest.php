<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Inertia\Testing\AssertableInertia as Assert;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '1234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
        'newsletter' => false,
    ]);

    $response->assertInertia(fn (Assert $page) => $page
        ->component('Auth/Register')
        ->where('showPricingTable', true)
        ->where('userEmail', 'test@example.com')
        ->has('userId')
        ->where('status', 'Registration successful! Please select a plan.')
    );

    $this->assertAuthenticated();
});

// Test to ensure a new user can register and get a Stripe account
test('new users can register and get a Stripe account', function () {
    // Simulate user registration
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => '1234567890',
        'password' => 'password',
        'password_confirmation' => 'password',
        'newsletter' => false,
    ]);

    // Assert the registration response
    $response->assertStatus(200);

    // Retrieve the user from the database
    $user = User::where('email', 'test@example.com')->first();
    $this->assertNotNull($user, 'User was not created.');

    // Mock the Stripe API response
    Http::fake([
        'https://api.stripe.com/*' => Http::response(['id' => 'acct_test_12345'], 200),
    ]);

    // Simulate the creation of a Stripe account
    $user->createAsStripeCustomer();

    // Assert that the user has a Stripe account ID
    $this->assertNotNull($user->stripe_id, 'Stripe account ID was not created for the user.');
});
