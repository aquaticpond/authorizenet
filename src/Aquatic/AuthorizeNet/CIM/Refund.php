<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;

class Refund extends Request
{
    protected $_soapMethod = 'CreateCustomerProfileTransaction';
    protected $_wsdl = 'CIM';

    public function __construct(float $amount, int $transaction_id)
    {
        $this->_request = [
            'transaction' => [
                'profileTransRefund' => [
                    'amount' => $amount,
                    'transId' => $transaction_id,
                ]
            ]
        ];
    }
}