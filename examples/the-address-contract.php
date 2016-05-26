<?php

// Maybe your source data is an array
$arraySource = [
    'name' => 'herp',
    'last' => 'derpington',
    'company' => 'derp LLC',
    'telephone' => '+1(123)456-7890 ext 1',
    'street' => '1234 street lane',
    'city' => 'citysville',
    'state' => 'stateland',
    'zip' => 12345,
    'country' => 'back in the ussr'
];

// Maybe your source data is an object with some properties
$objectSource = new stdClass();
$source->name = 'herp';
$source->last = 'derpington';
$source->company = 'derp LLC';
$source->telephone = '+1(123)456-7890 ext 1';
$source->street = '1234 street lane';
$source->city = 'citysville';
$source->state = 'stateland';
$source->zip = 12345;
$source->country = 'back in the ussr';

// You can map it with source_key => expected_key
$map = [
'name' => 'first_name',
'last' => 'last_name',
'telephone' => 'phone_number'
];

// And then instantiate an address implementing the required address contract with the map (if needed)
$address = new \Aquatic\AuthorizeNet\Address($source, $map);
var_dump($address);

// And make a request with the example facade
$response = \My\AuthorizeNet::createCustomerShippingAddress(123456, $address);
