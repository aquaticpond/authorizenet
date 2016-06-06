<?php

if(!function_exists('q'))
{
    function q($wat, $label)
    {
        echo "<strong>{$label}</strong>";
        echo '<pre>';
        var_dump($wat);
        echo '</pre>';
    }
}

use Aquatic\AuthorizeNet;
use Aquatic\AuthorizeNet\Address;
use Aquatic\AuthorizeNet\Request\Exception as RequestException;


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
$objectSource->name = 'herp';
$objectSource->last = 'derpington';
$objectSource->company = 'derp LLC';
$objectSource->telephone = '+1(123)456-7890 ext 1';
$objectSource->street = '1234 street lane';
$objectSource->city = 'citysville';
$objectSource->state = 'stateland';
$objectSource->zip = 12345;
$objectSource->country = 'back in the ussr';

// You can map it with source_key => expected_key
$map = [
'name' => 'first_name',
'last' => 'last_name',
'telephone' => 'phone_number'
];

// And then instantiate an address implementing the required address contract with the map (if needed)
$address = new Address($objectSource, $map);

// And make a request with the example facade
try
{
    $response = AuthorizeNet::createCustomerShippingAddress(123456, $address);
}
catch(RequestException $e)
{
    q($e->getMessage());
}