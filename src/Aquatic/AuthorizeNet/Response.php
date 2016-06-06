<?php

namespace Aquatic\AuthorizeNet;

use Aquatic\AuthorizeNet\Transaction\Exception;

class Response
{
    const TRANSACTION_RESPONSE_DELIMITER = "|";
    const TRANSACTION_RESPONSE_MAP = [
        'response_code',
        'response_sub_code',
        'response_reason_code',
        'response_reason_text',
        'authorization_code',
        'avs_response',
        'transaction_id',
        'invoice_number',
        'description',
        'amount',
        'method',
        'transaction_type',
        'customer_id',
        'first_name',
        'last_name',
        'company',
        'street',
        'city',
        'state',
        'post_code',
        'country',
        'phone',
        'fax',
        'email_address',
        'ship_to_first_name',
        'ship_to_last_name',
        'ship_to_company',
        'ship_to_address',
        'ship_to_city',
        'ship_to_state',
        'ship_to_post_code',
        'ship_to_country',
        'tax',
        'duty',
        'freight',
        'tax_exempt',
        'purchase_order_number',
        'md5',
        'cvv_response_code',
        'cavv_response_code',
        'unused41',
        'unused42',
        'unused43',
        'unused44',
        'unused45',
        'unused46',
        'unused47',
        'unused48',
        'unused49',
        'unused50',
        'account_number',
        'card_type',
        'split_tender_id',
        'requested_amount',
        'balance_on_card',
        'unused56',
        'unused57',
        'unused58',
        'unused59',
        'unused60',
        'unused61',
        'unused62',
        'unused63',
        'unused64',
        'unused65',
        'unused66',
        'unused67',
        'unused68',
    ];

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

    public function parseTransactionResponse(string $response)
    {
        $response = \explode(static::TRANSACTION_RESPONSE_DELIMITER, $response);
        foreach(static::TRANSACTION_RESPONSE_MAP as $pos => $property)
            $this->$property = $response[$pos];

        if($this->response_reason_code != 1)
            throw new Exception($this->response_reason_text, $this->response_reason_code);

    }

}