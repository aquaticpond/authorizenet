<?php

if(!function_exists('q'))
{
    function q($wat, $label)
    {
        echo "<strong>{$label}</strong>";
        echo '<pre>';
        var_dump($wat);
        echo '</pre>';
    }
}

use Aquatic\AuthorizeNet;
use Aquatic\AuthorizeNet\Request\Exception as RequestException;
use Aquatic\AuthorizeNet\Transaction\Exception as TransactionException;

try
{
    $transaction_id = 1234567890;
    $response = AuthorizeNet::void($transaction_id);
}
catch(RequestException $e)
{
    q($e->getMessage(), "Request Exception {$e->getCode()}:");
}
catch(TransactionException $e)
{
    q($e->getMessage(), "Transaction Exception {$e->getCode()}:");
}
