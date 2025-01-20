<?php

namespace App\Pipes;

use App\Models\User;

// use Square\Apis\CustomersApi;

class CreateSquareUser
{
    public function handle(User $user, \Closure $next)
    {
        // // Logic to create a Square user
        // $squareUser = $this->createSquareUser($request);

        // // Add the Square user to the request
        // $request->merge(['square_user' => $squareUser]);

        // Imitate that we have created a square user and subscription
        $user->update([
            'square_user_id' => 'fake-id',
            'square_subscription_id' => 'fake-subscription-id',
        ]);

        return $next($user);
    }

    protected function createSquareUser($request)
    {
        $body = \Square\Models\CreateCustomerRequestBuilder::init()
            ->givenName($request->input('name'))
            ->emailAddress($request->input('email'))
            ->build();

        $apiResponse = $this->customersApi->createCustomer($body);

        if ($apiResponse->isSuccess()) {
            $createCustomerResponse = $apiResponse->getResult();

            return $createCustomerResponse->getCustomer();
        } else {
            return ['errors' => $apiResponse->getErrors()];
        }
    }
}
