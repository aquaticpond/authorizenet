<?php

use Aquatic\AuthorizeNet\Request\Exception as RequestException;
use Aquatic\AuthorizeNet\Transaction\Exception as TransactionException;

try
{
    $amount = 10;
    $customer_id = 123456789;
    $payment_profile_id = 123456789;
    $transaction_id = 123456789;
    $result = \Aquatic\AuthorizeNet::refund($amount, $customer_id, $payment_profile_id, $transaction_id);
}
catch(RequestException $e)
{
    q($e->getMessage(), "Request Exception {$e->getCode()}:");
}
catch(TransactionException $e)
{
    q($e->getMessage(), "Transaction Exception {$e->getCode()}:");
}