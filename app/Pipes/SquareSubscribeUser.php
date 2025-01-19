<?php

namespace App\Pipes;

use Closure;

class SquareSubscribeUser
{
    public function handle($user, Closure $next)
    {
        // Call Square API to process payment
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'https://connect.squareupsandbox.com',
            'headers' => [
                'Authorization' => 'Bearer '.env('SQUARE_ACCESS_TOKEN'),
                'Content-Type' => 'application/json',
            ],
        ]);

        $customersApi = $client->getCustomersApi();

        $apiResponse = $customersApi->createCustomer([
            'email_address' => $user->email,
        ]);
        if ($apiResponse->isSuccess()) {
            $createCustomerResponse = $apiResponse->getResult();
        } else {
            $errors = $apiResponse->getErrors();
            abort(422, 'Payment failed.');
        }

        // Getting more response information
        var_dump($apiResponse->getStatusCode());
        var_dump($apiResponse->getHeaders());

        if (! $apiResponse->isSuccess()) {
            abort(422, 'Payment failed.');
        }

        return $next($user); // Pass to the next pipe if successful
    }
}
