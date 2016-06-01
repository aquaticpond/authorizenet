<?php

use Aquatic\AuthorizeNet\Contract\Address;
use Aquatic\AutorizeNet\Contract\CreditCard;
use Aquatic\AuthorizeNet\CIM\CreateCustomerProfile;
use Aquatic\AuthorizeNet\CIM\CreateCustomerShippingAddress;

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

    public static function createCustomerShippingAddress(int $customer_id, Address $address)
    {
        return (new CreateCustomerShippingAddress($customer_id, $address))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->sendRequest()
            ->parseResponse();
    }
    
    public static function createCustomerPaymentProfile(int $customer_id, CreditCard $card, Address $address)
    {
        return (new UpdateCustomerPaymentProfile($customer_id, $card, $address))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->sendRequest()
            ->parseResponse();
    }

    public static function updateCustomerPaymentProfile(int $customer_id, int $payment_profile_id, CreditCard $card, Address $address)
    {
        return (new UpdateCustomerPaymentProfile($customer_id, $payment_profile_id, $card, $address))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->sendRequest()
            ->parseResponse();
    }
}