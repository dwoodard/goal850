<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class ArrayTokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // check users array user token to see if it is valid
        $user = $request->user();

        // 🚧 Hasn't completed Array user
        if (! $user->hasCompletedArrayUser()) {
            return Redirect::route('registration.wizard.user');
        }

        // 🚧 Hasn't completed Array KBA
        if (! $user->hasCompletedArrayUserToken()) {
            return Redirect::route('registration.wizard.kba');
        }

        // $response = Http::withHeaders([
        //     'accept' => 'application/json',
        //     'x-array-server-token' => config('array.api_token'),
        //     // 'x-array-user-token' => $user->array_user_token,
        // ])->get(config('array.api_url').'/api/user/v2?userId='.$user->array_user_id);

        // $array_user = $response->json();

        // if the user is not authenticated, redirect to the registration wizard
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'x-array-server-token' => config('array.api_token'),
        ])
            ->post(config('array.api_url').'/api/authenticate/v2/usertoken', [
                'appKey' => config('array.app_key'),
                'userId' => $user->array_user_id,
                'ttlInMinutes' => 60,
            ]);

        $token = $response->json('userToken');

        if ($token) {
            $user->update([
                'array_user_token' => $token,
            ]);
        }

        // based on the response look for authenticated, true or false

        return $next($request);
    }
}
