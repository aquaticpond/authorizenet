<?php

namespace Aquatic\AuthorizeNet\Contract;

interface CreditCard
{
    public function getNumber(): int;
    public function getCVV(): int;
    public function getExpirationDate(): string;
}