<?php

use Aquatic\AuthorizeNet\Request\Exception as RequestException;
use Aquatic\AuthorizeNet\Transaction\Exception as TransactionException;

//  create customer profile
try
{
    $internal_customer_id = 1;
    $email = "harry@hogwarts.com";
    $description = "yer a customer harry!";
    $result = \Aquatic\AuthorizeNet::createCustomerProfile($internal_customer_id, $email, $description);
    $customer_id = $result->customerProfileId;
}
catch(RequestException $e)
{
    q($e->getMessage(), "Request Exception {$e->getCode()}:");
    die();
}


// create payment profile
try
{
    $arraySource = [
        'first' => 'rubeus',
        'last' => 'pants',
        'company' => 'derp inc',
        'wizard_phone' => '1234567890',
        'street' => '1234 street lane',
        'city' => 'citysville',
        'state' => 'stateland',
        'zip' => 66666,
        'country' => 'back in the ussr'
    ];

    $map = [
        'first' => 'first_name',
        'last' => 'last_name',
        'wizard_phone' => 'phone_number'
    ];

    $card = new \Aquatic\AuthorizeNet\CreditCard(4007000000027, 123, '2019-04'); // visa testing number
    $address = new \Aquatic\AuthorizeNet\Address($arraySource, $map);
    $result = \Aquatic\AuthorizeNet::createCustomerPaymentProfile($customer, $card, $address);
    $payment_profile = $result->customerPaymentProfileId;
    q($result, 'result!');
}
catch(RequestException $e)
{
    q($e->getMessage(), "Request Exception {$e->getCode()}:");
    die();
}
catch(TransactionException $e)
{
    q($e->getMessage(), "Transaction Exception {$e->getCode()}:");
    die();
}



// authorize
try
{
    $amount = 30.50;
    $result = \Aquatic\AuthorizeNet::authorize($amount, $customer, $payment_profile, 'yer-an-invoice-harry');
    q($result, 'result!');
}
catch(RequestException $e)
{
    q($e->getMessage(), "Request Exception {$e->getCode()}:");
    die();
}
catch(TransactionException $e)
{
    q($e->getMessage(), "Transaction Exception {$e->getCode()}:");
    die();
}


// capture
try
{
    $result = \Aquatic\AuthorizeNet::capture($amount, $transaction_id);
    q($result, 'result!');
}
catch(RequestException $e)
{
    q($e->getMessage(), "Request Exception {$e->getCode()}:");
    die();
}
catch(TransactionException $e)
{
    q($e->getMessage(), "Transaction Exception {$e->getCode()}:");
    die();
}

