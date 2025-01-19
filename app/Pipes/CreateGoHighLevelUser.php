<?php

namespace App\Pipes;

use App\Services\GoHighLevelApi;
use Closure;

class CreateGoHighLevelUser
{
    public function handle($user, Closure $next)
    {
        // Call Go High Level API to create user
        // $ghlId = GoHighLevelApi::createUser($user);

        // Save Go High Level ID to user model
        // $user->ghl_id = $ghlId;
        // $user->save();

        return $next($user);
    }
}
