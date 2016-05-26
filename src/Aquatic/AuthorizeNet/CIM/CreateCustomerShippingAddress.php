<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;
use Aquatic\AuthorizeNet\Contract\Address;

class CreateCustomerShippingAddress extends Request
{
    protected $_soapMethod = 'CreateCustomerShippingAddress';
    protected $_wsdl = 'CIM';
    protected $_validationMode = 'none';

    public function __construct(int $profile_id, Address $address)
    {
        $this->_request = [
            'customerProfileId' => $profile_id,
            'address' => [
                'firstName' => $address->getFirstName(),
                'lastName'  => $address->getLastName(),
                'company'   => $address->getCompany(),
                'address'   => $address->getStreet(),
                'city'      => $address->getCity(),
                'state'     => $address->getState(),
                'zip'       => $address->getZip(),
                'country'   => $address->getCountry(),
                'phoneNumber'=> $address->getPhoneNumber(),
            ],
        ];
    }
}