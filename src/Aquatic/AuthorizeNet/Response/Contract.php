<?php

namespace Aquatic\AuthorizeNet\Response;

interface Contract
{
    public function parse($response): Contract;
}