<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;
use Aquatic\AuthorizeNet\Contract\Address;

class CreateCustomerPaymentProfile extends Request
{
    protected $_soapMethod = 'UpdateCustomerPaymentProfile';
    protected $_wsdl = 'CIM';
    
    public function __construct(int $customer_id, int $payment_profile_id, string $card_number, string $expiration_date, string $cvv, Address $address)
    {
        $this->_request = [
            'customerProfileId' => $customer_id,
            'paymentProfile' => [
                'customer_payment_profile_id' => $payment_profile_id,
                'billTo' => [
                    'firstName' => $address->getFirstName(),
                    'lastName'  => $address->getLastName(),
                    'company'   => $address->getCompany(),
                    'address'   => $address->getStreet(),
                    'city'      => $address->getCity(),
                    'state'     => $address->getState(),
                    'zip'       => $address->getZip(),
                    'country'   => $address->getCountry(),
                    'phoneNumber' => $address->getPhoneNumber()
                ],
                'payment' => [
                    'creditCard' => [
                        'cardNumber' => $card_number,
                        'expirationDate' => $expiration_date,
                        'cardCode'       => $cvv,
                    ]
                ],
            ]
        ];
    }
}