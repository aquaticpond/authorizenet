<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;
use Aquatic\AuthorizeNet\Contract\Address;
use Aquatic\AuthorizeNet\Contract\CreditCard;

class CreateCustomerPaymentProfile extends Request
{
    protected $_soapMethod = 'CreateCustomerPaymentProfile';
    protected $_wsdl = 'CIM';
    
    public function __construct(int $id, CreditCard $card, Address $address)
    {
        $this->_request = [
            'customerProfileId' => $id,
            'paymentProfile' => [
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