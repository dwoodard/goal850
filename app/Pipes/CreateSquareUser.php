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
            $customer = $result->getCustomer();
            $user->update([
                'square_user_id' => $customer->getId(),
                'square_subscription_id' => 'some-real-subscription-id',
            ]);
        } else {
            $errors = $api_response->getErrors();
        }

        return $next($user);
    }
}
