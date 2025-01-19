<?php

namespace App\Pipes;

use App\Services\ArrayApi;
use Closure;

class CreateArrayUser
{
    public function handle($user, Closure $next)
    {
        // Call Array.com API to create user
        $arrayId = ArrayApi::createUser($user);

        // Save Array ID to user model
        $user->array_id = $arrayId;
        $user->save();

        return $next($user);
    }
}
