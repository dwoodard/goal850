<?php

namespace App\Pipes;

use Square\Apis\CustomersApi;

class CreateSquareUser
{
    protected $customersApi;

    public function __construct(CustomersApi $customersApi)
    {
        $this->customersApi = $customersApi;
    }

    public function handle($request, \Closure $next)
    {
        // Logic to create a Square user
        $squareUser = $this->createSquareUser($request);

        // Add the Square user to the request
        $request->merge(['square_user' => $squareUser]);

        return $next($request);
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
