<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;

class Refund extends Request
{
    protected $_soapMethod = 'CreateCustomerProfileTransaction';
    protected $_wsdl = 'CIM';

    public function __construct(float $amount, int $customer_id, int $payment_profile_id, int $transaction_id)
    {
        $this->_request = [
            'transaction' => [
                'profileTransRefund' => [
                    'amount' => $amount,
                    'customerProfileId' => $customer_id,
                    'customerPaymentProfileId' => $payment_profile_id,
                    'transId' => $transaction_id,
                ]
            ]
        ];
    }
}