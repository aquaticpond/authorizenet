<?php

namespace Aquatic\AuthorizeNet;

use Aquatic\AuthorizeNet\Contract\CreditCard as Contract;

class CreditCard implements Contract
{
    public static $expiration_date_format = '\d{2}-\d{4}';
    public $number, $cvv, $expiration_date;

    public function __construct(int $number, int $cvv, int $expiration_date)
    {
        if(!preg_match(static::$expiration_date_format, $expiration_date))
            throw new \InvalidArgumentException("Expiration date must be in mm-yyyy format");

        $this->number = $number;
        $this->cvv = $cvv;
        $this->expiration_date = $expiration_date;
    }


    public function getNumber()
    {
        return $this->number;
    }

    public function getCVV()
    {
        return $this->cvv;
    }

    public function getExpirationDate()
    {
        return $this->expiration_date;
    }
}