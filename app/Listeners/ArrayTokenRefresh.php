<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class ArrayTokenRefresh
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $user->refreshArrayToken();
    }
}
