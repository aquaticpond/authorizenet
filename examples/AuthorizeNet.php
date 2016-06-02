<?php

use Aquatic\AuthorizeNet\Contract\Address;
use Aquatic\AuthorizeNet\Contract\CreditCard;
use Aquatic\AuthorizeNet\CIM\CreateCustomerProfile;
use Aquatic\AuthorizeNet\CIM\CreateCustomerShippingAddress;
use Aquatic\AuthorizeNet\CIM\CreateCustomerPaymentProfile;
use Aquatic\AuthorizeNet\CIM\UpdateCustomerPaymentProfile;
use Aquatic\AuthorizeNet\CIM\Authorize;
use Aquatic\AuthorizeNet\CIM\Capture;
use Aquatic\AuthorizeNet\CIM\Refund;
use Aquatic\AuthorizeNet\CIM\Void;

// Facade for AuthorizeNet requests
class AuthorizeNet
{

    public static function createCustomerProfile(string $customer_id, string $email, string $description = null)
    {
        return (new CreateCustomerProfile($customer_id, $email, $description))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->setQA(getenv('AUTHORIZENET_QA'))
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
            ->setQA(getenv('AUTHORIZENET_QA'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }
    
    public static function createCustomerPaymentProfile(int $customer_id, CreditCard $card, Address $address)
    {
        return (new CreateCustomerPaymentProfile($customer_id, $card, $address))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->setQA(getenv('AUTHORIZENET_QA'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }

    public static function updateCustomerPaymentProfile(int $customer_id, int $payment_profile_id, CreditCard $card, Address $address)
    {
        return (new UpdateCustomerPaymentProfile($customer_id, $payment_profile_id, $card, $address))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->setQA(getenv('AUTHORIZENET_QA'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }

    public static function authorize(float $amount, int $customer_id, int $payment_profile_id, string $invoice_id = '', int $cvv = '')
    {
        return (new Authorize($amount, $customer_id, $payment_profile_id, $invoice_id, $cvv))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->setQA(getenv('AUTHORIZENET_QA'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }

    public static function capture(float $amount, int $transaction_id)
    {
        return (new Capture($amount, $transaction_id))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->setQA(getenv('AUTHORIZENET_QA'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }

    public static function refund(float $amount, int $transaction_id)
    {
        return (new Refund($amount, $transaction_id))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->setQA(getenv('AUTHORIZENET_QA'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }

    public static function void(int $transaction_id)
    {
        return (new Void($transaction_id))
            ->setCredentials(getenv('AUTHORIZENET_ID'), getenv('AUTHORIZENET_KEY'))
            ->setQA(getenv('AUTHORIZENET_QA'))
            ->sendRequest()
            ->parseResponse()
            ->getResponse();
    }
}