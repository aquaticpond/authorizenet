<?php

namespace Aquatic\AuthorizeNet\Request;

use SoapClient;

interface Contract
{
    public function setCredentials(string $name, string $key): Contract;
    public function setValidationMode(string $mode = null): Contract;
    public function setQA(bool $isQA = false): Contract;

    public function sendRequest(): Contract;
    public function parseResponse(): Contract;

    public function getSoap(): SoapClient;
    public function getWsdl(): string;
    public function getRequest(): array;
    public function getResponse();
}