<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;

class Capture extends Request
{
    protected $_soapMethod = 'CreateCustomerProfileTransaction';
    protected $_wsdl = 'CIM';

    public function __construct(float $amount, int $transaction_id)
    {
        $this->_request = [
            'transaction' => [
                'profileTransPriorAuthCapture' => [
                    'amount' => $amount,
                    'transId' => $transaction_id,
                ]
            ]
        ];
    }
}