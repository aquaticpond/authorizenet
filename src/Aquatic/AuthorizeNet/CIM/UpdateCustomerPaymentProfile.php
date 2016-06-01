<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;
use Aquatic\AuthorizeNet\Contract\Address;
use Aquatic\AuthorizeNet\Contract\CreditCard;

class UpdateCustomerPaymentProfile extends Request
{
    protected $_soapMethod = 'UpdateCustomerPaymentProfile';
    protected $_wsdl = 'CIM';
    
    public function __construct(int $customer_id, int $payment_profile_id, CreditCard $card, Address $address)
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
                        'cardNumber' => $card->getNumber(),
                        'expirationDate' => $card->getExpirationDate(),
                        'cardCode'       => $card->getCVV(),
                    ]
                ],
            ]
        ];
    }
}