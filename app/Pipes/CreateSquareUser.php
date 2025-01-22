<?php

namespace App\Pipes;

use App\Models\User;
use Square\SquareClient;

class CreateSquareUser
{
    protected $client;

    // get the square api to create a customer and set the square user id and subscription id
    public function __construct(SquareClient $client)
    {
        $this->client = $client;
    }

    public function handle(User $user, \Closure $next)
    {

        $customer = new \Square\Models\CreateCustomerRequest;
        $customer->setGivenName($user->name);
        $customer->setEmailAddress($user->email);

        $api_response = $this->client->getCustomersApi()->createCustomer($customer);

        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();
        } else {
            $errors = $api_response->getErrors();
        }

        $request = \Square\Models\CreateCustomerRequestBuilder::init()
            ->givenName($user->name)
            ->emailAddress($user->email)
            ->build();

        $response = $this->customersApi->createCustomer($request);

        if ($response->isSuccess()) {
            $customer = $response->getResult()->getCustomer();
            $user->update([
                'square_user_id' => $customer->getId(),
                'square_subscription_id' => 'some-real-subscription-id',
            ]);
        } else {
            // Handle the error case
            $errors = $response->getErrors();
            // Log the errors or handle them as needed
        }

        return $next($user);
    }
}
