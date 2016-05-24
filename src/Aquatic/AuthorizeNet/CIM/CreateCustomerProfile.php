<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;

class CreateCustomerProfile extends Request
{
    protected $_soapMethod = 'CreateCustomerProfile';

    protected $_request = [
        'profile' => [
            'merchantCustomerId' => null,
            'description' => null,
            'email' => null,
        ],
    ];

    public function __construct(string $id, string $description, string $email)
    {
        $this->_request['profile']['merchantCustomerId'] = $id;
        $this->_request['profile']['description'] = $description;
        $this->_request['profile']['email'] = $email;

        $this->setValidationMode('none');
    }

    
}