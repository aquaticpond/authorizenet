<?php

namespace My;

use Aquatic\AuthorizeNet\CIM\CreateCustomerProfile;

class CreateAProfile extends CreateCustomerProfile
{
    public function __construct(string $id, string $email)
    {
        parent::__construct($id, $email, 'yer a customer harry!');

        $this->setCredentials('rubeus', 'hagrid')
             ->sendRequest()
             ->parseResponse();
    }

    public function parseResponse()
    {
        parent::parseResponse();

        $this->_response->yer_my_custom_parsed_response_harry = true;

        return this;
    }
}