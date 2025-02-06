<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_login_tracking_updates_fields(): void
    {
       
        // Create a user with a known password.
        $user = User::create([
            'first_name' => 'Test',
            'last_name'  => 'User',
            'email'      => 'test@example.com',
            'password'   => Hash::make('password'),
        ]);

        $loginData = [
            'email'    => 'test@example.com',
            'password' => 'password',
        ];

        // Custom headers for simulation.
        $headers = [
            'User-Agent' => 'TestBrowser/1.0'
        ];

        // Perform the login request.
        $response = $this->post('/login', $loginData, $headers);

        $response->assertRedirect(); // assuming login redirects

        // Refresh the user from the database.
        $user->refresh();

        $this->assertEquals(1, $user->login_count);
        $this->assertEquals('127.0.0.1', $user->last_ip);
        $this->assertEquals('TestBrowser/1.0', $user->user_agent);
    }
}
