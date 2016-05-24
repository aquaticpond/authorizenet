<?php

namespace Aquatic\AuthorizeNet;

use Aquatic\AuthorizeNet\Response\Contract;

class Response implements Contract
{
    public function parse($response): Contract
    {
        foreach($response as $property => $value)
            $this->$property = $value;

        return $this;
    }
}