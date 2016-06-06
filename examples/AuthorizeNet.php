<?php

use Aquatic\AuthorizeNet as Facade;
use My\CreateAProfile;

// Facade for AuthorizeNet requests
class AuthorizeNet extends Facade
{
    public static function yerACustomerProfileHarry(string $id, string $email)
    {
        return (new CreateAProfile($id, $email))
                ->setCredentials('rubeus', 'hagrid')
                ->sendRequest()
                ->parseResponse()
                ->getResponse();
    }
}