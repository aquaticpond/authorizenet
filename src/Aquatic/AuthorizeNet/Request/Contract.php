<?php

namespace Aquatic\AuthorizeNet\Request;

use Aquatic\AuthorizeNet\Response\Contract as ResponseContract;

interface Contract
{
    public function getRequest(): array;
    public function setCredentials(string $name, string $key): Contract;
    public function send(): ResponseContract;
    public function getWsdl(): string;
}