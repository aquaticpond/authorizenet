<?php

namespace Aquatic\AuthorizeNet\CIM;

use Aquatic\AuthorizeNet\Request;

class CreateCustomerProfile extends Request
{
    protected $_soapMethod = 'CreateCustomerProfile';
    protected $_wsdl = 'CIM';
    protected $_validationMode = 'none';
    
    public function __construct(string $id, string $email, string $description = null)
    {
        $this->_request = [
            'profile' => [
                'merchantCustomerId' => $id,
                'description' => $description,
                'email' => $email,
            ],
        ];
    }
}