<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;

class Authorize extends Request
{
    protected $_soapMethod = 'CreateCustomerProfileTransaction';
    protected $_wsdl = 'CIM';

    public function __construct(float $amount, int $customer_id, int $payment_profile_id, string $invoice_id, int $cvv = null)
    {
        $this->_request = [
            'transaction' => [
                'profileTransAuthOnly' => [
                    'amount' => $amount,
                    'customerProfileId' => $customer_id,
                    'customerPaymentProfileId' => $payment_profile_id,
                    'order' => [
                        'invoiceNumber' => $invoice_id
                    ],
                    'cardCode' => $cvv,
                ]
            ]
        ];
    }
}