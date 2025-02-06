<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'billingAddress' => '123 Test St',
        'contractAccepted' => true,
    ]);
    

   


    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
