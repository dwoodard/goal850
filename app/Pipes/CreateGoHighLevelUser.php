<?php

namespace App\Pipes;

use App\Models\User;
// use App\Services\GoHighLevelApi;
use Closure;

class CreateGoHighLevelUser
{
    public function handle(User $user, Closure $next)
    {
        // Call Go High Level API to create user
        // $ghlId = GoHighLevelApi::createUser($user);

        // Save Go High Level ID to user model
        // $user->ghl_id = $ghlId;
        // $user->save();

        // Imitate that we have created a Go High Level user
        $user->update([
            'ghl_user_id' => 'fake-glh-id',
        ]);

        return $next($user);
    }
}
