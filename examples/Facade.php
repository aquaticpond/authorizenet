<?php

use Aquatic\AuthorizeNet\CIM\CreateCustomerProfile;

// Facade for AuthorizeNet requests
class AuthorizeNet
{
    public static function createCustomerProfile(string $customer_id, string $email, string $description = null)
    {
        return (new CreateCustomerProfile($customer_id, $email, $description))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }

    public static function yerACustomerProfileHarry(string $customer_id, string $email)
    {
        return (new \My\CreateAProfile($customer_id, $email))->getResponse();
    }
}

// Call from your application to receive parsed response
// AuthorizeNet::createCustomerProfile(123, 'herp@derpingt.on', 'guest');

// Call from your application to receive your custom parsed response
// AuthorizeNet::yerACustomerProfileHarry(321, 'harry@hogwar.ts');