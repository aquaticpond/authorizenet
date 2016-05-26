<?php

// Use the example facade to succinctly receive a parsed response
$response = AuthorizeNet::createCustomerProfile(123, 'herp@derpingt.on', 'Yer a profile harry!');

// Use the example facade to succinctly receive your custom \My\CreateAProfile parsed response
$customResponse = AuthorizeNet::yerACustomerProfileHarry(321, 'harry@hogwar.ts');



// Or make a request directly with the fluent API
$request = (new \Aquatic\AuthorizeNet\CIM\CreateCustomerProfile(432, 'herp@derpingt.on'))
    ->setCredentials('your', 'credentials')
    ->sendRequest();

// Maybe you need to access the raw SOAP data for debugging?
$soap = $request->getSoap();

// Maybe you want the raw response
$rawResponse = $request->getResponse();

// Maybe you want to get a specially parsed response
$parsedResponse = $request->parseResponse()->getResponse();