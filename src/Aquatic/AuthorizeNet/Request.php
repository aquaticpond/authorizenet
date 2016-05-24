<?php

namespace Aquatic\AuthorizeNet;

\ini_set("soap.wsdl_cache_enabled", "0");

use SoapClient;
use Aquatic\AuthorizeNet\Request\Contract as RequestContract;
use Aquatic\AuthorizeNet\Response\Contract as ResponseContract;

abstract class Request implements RequestContract
{
    protected $_credentials = [
        'MerchantAuthentication' => [
            'name' => null,
            'transactionKey' => null,
        ],
    ];

    protected $_validationMode = [
        'validationMode' => null
    ];

    protected $_request = [];
    protected $_wsdl;
    protected $_soapMethod;
    protected $_isQA = false;

    public function send(ResponseContract $response_parser = null): ResponseContract
    {
        $soap = new SoapClient($this->getWsdl(), ['trace' => 1]);

        $method = $this->_soapMethod;
        $result = $soap->$method($this->getRequest());
        
        if(!$response_parser)
            $response_parser = new \Aquatic\AuthorizeNet\Response;
        
        return $response_parser->parse($result);
    }

    public function setCredentials(string $name, string $key): RequestContract
    {
        $this->_credentials['merchantAuthentication']['name'] = $name;
        $this->_credentials['merchantAuthentication']['transactionKey'] = $key;

        return $this;
    }

    public function setQA(bool $isQA = false)
    {
        $this->_isQA = $isQA;

        return $this;
    }

    public function setValidationMode(string $mode = null)
    {
        $mode = $mode ?? $this->_validationMode['validationMode'];

        if(!$mode && $this->_isQA)
            $mode = 'testMode';

        if(!$mode && !$this->_isQA)
            $mode = 'liveMode';

        $this->_validationMode = ['validationMode' => $mode];

        return $this;
    }

    public function getRequest(): array
    {
        return array_merge($this->_credentials, $this->_request, $this->_validationMode);
    }

    public function getWsdl(): string
    {
        $qa = $this->_isQA ? '-test' : '';
        $wsdl = array_slice(explode('\\', static::class),-2,1)[0];
        return dirname(__FILE__)."/wsdl/{$wsdl}{$qa}.wsdl";
    }
}