<?php

namespace App\Pipes;

use App\Models\User;
// use App\Services\ArrayApi;
use Closure;

class CreateArrayUser
{
    public function handle(User $user, Closure $next)
    {
        // Call Array.com API to create user
        // $arrayId = ArrayApi::createUser($user);

        // Save Array ID to user model

        // Imitate that we have created a Go High Level user
        $user->update([
            'array_user_id' => 'fake-array-id',
            'array_user_token' => 'fake-array-token',
        ]);

        return $next($user);
    }
}
