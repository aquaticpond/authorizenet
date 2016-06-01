<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;

class Void extends Request
{
    protected $_soapMethod = 'CreateCustomerProfileTransaction';
    protected $_wsdl = 'CIM';

    public function __construct(int $transaction_id)
    {
        $this->_request = [
            'transaction' => [
                'profileTransVoid' => [
                    'transId' => $transaction_id,
                ]
            ]
        ];
    }
}