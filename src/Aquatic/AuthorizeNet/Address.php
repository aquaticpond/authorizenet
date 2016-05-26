<?php

namespace Aquatic\AuthorizeNet;

use Aquatic\AuthorizeNet\Contract\Address as Contract;

class Address implements Contract
{
    public $first_name = '',
           $last_name = '',
           $phone_number = '',
           $company = '',
           $street = '',
           $city = '',
           $state = '',
           $zip = '', 
           $country = '';


    public function __construct($source, array $map = [])
    {
        if(!(is_array($source) || is_object($source)))
            throw new Exception("You must pass an array or object as the source data for an address.");

        foreach($source as $key => $val)
        {
            if(array_key_exists($key, $map))
                $key = $map[$key];

            if(property_exists($this, $key))
                $this->$key = $this->sanitize($key, $val);
        }
    }

    public function sanitize(string $key, string $value): string
    {
        $value = preg_replace("/&([a-zA-Z])[a-zA-Z]+;/i", "$1", htmlentities($value));
        switch($key)
        {
            case 'first_name':
            case 'last_name':
            case 'company':
                return substr($value, 0, 49);
                break;
            case 'street':
            case 'country':
                return substr($value, 0, 59);
                break;
            case 'city':
            case 'state':
                return substr($value, 0, 39);
                break;
            case 'zip':
                return substr($value, 0, 19);
                break;
            case 'phone_number':
                return substr(preg_replace('/[^a-zA-Z0-9-() ]/', '', $value), 0 ,24);
                break;
            default: return '';
        }
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}