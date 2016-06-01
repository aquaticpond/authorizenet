<?php

namespace Aquatic\AuthorizeNet;

\ini_set("soap.wsdl_cache_enabled", "0");

use stdClass;
use SoapClient;
use Aquatic\AuthorizeNet\Request\Contract;
use Aquatic\AuthorizeNet\Request\Exception;

abstract class Request implements Contract
{
    const SUCCESS_CODE = 'I00001';

    protected $_credentials = [
        'id' => null,
        'key' => null
    ];

    protected $_validationMode = 'liveMode';
    protected $_isQA = false;
    protected $_request = [];
    protected $_response;
    protected $_wsdl;
    protected $_soapMethod;
    protected $_soapInstance;

    public function sendRequest(): Contract
    {
        $method = $this->_soapMethod;

        $this->_response = $this->getSoap()
                                ->$method($this->getRequest());

        return $this;
    }

    public function parseResponse(): Contract
    {
        $response = new stdClass();

        $wrapper = $this->_soapMethod.'Result';
        foreach($this->_response->$wrapper as $property => $value)
            $response->$property = $value;

        $this->_response = $response;

        foreach($response->messages as $message)
            if($message->code != static::SUCCESS_CODE)
                throw new Exception($message->text);

        return $this;
    }

    public function setCredentials(string $id, string $key): Contract
    {
        $this->_credentials['id'] = $id;
        $this->_credentials['key']  = $key;

        return $this;
    }

    public function setQA(bool $isQA = false): Contract
    {
        $this->_isQA = $isQA;

        return $this;
    }

    public function setValidationMode(string $mode = null): Contract
    {
        $mode = $mode ?? $this->_validationMode;

        if(!$mode && $this->_isQA)
            $mode = 'testMode';

        if(!$mode && !$this->_isQA)
            $mode = 'liveMode';

        $this->_validationMode = $mode;

        return $this;
    }

    public function getRequest(): array
    {
        $credentials = [
            'merchantAuthentication' => [
                'name' => $this->_credentials['id'],
                'transactionKey' => $this->_credentials['key'],
            ],
        ];

        $validationMode = [
            'validationMode' => $this->_validationMode
        ];

        return array_merge($credentials, $this->_request, $validationMode);
    }

    public function getResponse()
    {
        return $this->_response;
    }

    public function getSoap(): SoapClient
    {
        if(!($this->_soapInstance instanceof SoapClient))
            $this->_soapInstance = new SoapClient($this->getWsdl(), ['trace' => 1]);

        return $this->_soapInstance;
    }

    public function getWsdl(): string
    {
        $qa = $this->_isQA ? '-test' : '';
        return dirname(__FILE__)."/wsdl/{$this->_wsdl}{$qa}.wsdl";
    }
}