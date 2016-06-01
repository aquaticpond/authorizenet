<?php

namespace Aquatic\AuthorizeNet;

use Aquatic\AuthorizeNet\Contract\CreditCard as Contract;

class CreditCard implements Contract
{
    public static $expiration_date_format = '/\d{4}-\d{2}/';
    public $number, $cvv, $expiration_date;

    public function __construct(int $number, int $cvv, string $expiration_date)
    {
        if(!preg_match(static::$expiration_date_format, $expiration_date))
            throw new \InvalidArgumentException("Expiration date must be in yyyy-mm format");

        $this->number = $number;
        $this->cvv = $cvv;
        $this->expiration_date = $expiration_date;
    }


    public function getNumber(): int
    {
        return $this->number;
    }

    public function getCVV(): int
    {
        return $this->cvv;
    }

    public function getExpirationDate(): string
    {
        return $this->expiration_date;
    }
}