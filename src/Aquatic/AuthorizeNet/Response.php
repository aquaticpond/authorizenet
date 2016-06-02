<?php

namespace Aquatic\AuthorizeNet;

class Response
{
    protected $_request;
    protected $_raw;

    public function __construct(Request $request, $raw)
    {
        $this->_request = $request;
        $this->_raw = $raw;
    }

    public function getRaw()
    {
        return $this->_raw;
    }

    public function getRequest(): Request
    {
        return $this->_request;
    }
}