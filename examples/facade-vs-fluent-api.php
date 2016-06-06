<?php

// Use the facade to succinctly receive a parsed response
$response = \Aquatic\AuthorizeNet::credentials('api_id', 'api_key')->createCustomerProfile(123, 'herp@derpingt.on', 'Yer a profile harry!');

// Use the example facade to succinctly receive your custom \My\CreateAProfile parsed response
// Don't need to set credentials because they are set in the custom facade
$customResponse = AuthorizeNet::yerACustomerProfileHarry(321, 'harry@hogwar.ts');

// Or make a request directly with the fluent API
$request = (new \Aquatic\AuthorizeNet\CIM\CreateCustomerProfile(432, 'herp@derpingt.on'))
                ->setCredentials('your', 'credentials')
                ->sendRequest();

// Maybe you need to access the raw SOAP data for debugging?
$soap = $request->getSoap();

// Maybe you want the raw response
$rawResponse = $request->getResponse();

// Maybe you want to parse the response so that it normalizes the transaction properties and throws useful exceptions
$parsedResponse = $request->parseResponse()->getResponse();