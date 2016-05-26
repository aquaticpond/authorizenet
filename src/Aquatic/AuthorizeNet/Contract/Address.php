<?php

namespace Aquatic\AuthorizeNet\Contract;

interface Address
{
    public function getFirstName(): string;
    public function getLastName(): string;
    public function getCompany(): string;
    public function getStreet(): string;
    public function getCity(): string;
    public function getState(): string;
    public function getZip(): string;
    public function getCountry(): string;
    public function getPhoneNumber(): string;
}