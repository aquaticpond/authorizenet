#PHP7 wrapper for Authorize.net SOAP APIs

```php

use Aquatic\AuthorizeNet;
use Aquatic\AuthorizeNet\Address;
use Aquatic\AuthorizeNet\CreditCard;
use Aquatic\AuthorizeNet\Request\Exception as RequestException;
use Aquatic\AuthorizeNet\Transaction\Exception as TransactionException;

// set us up the credentials
$is_qa = 1; //qa mode set validationMode parameter to testMode
AuthorizeNet::credentials('api_id', 'api_key', $is_qa);

//  create customer profile
$internal_customer_id = 1;
$email = "harry@hogwarts.com";
$description = "yer a customer harry!";
$result = AuthorizeNet::createCustomerProfile($internal_customer_id, $email, $description);
$customer_id = $result->customerProfileId;

// create payment profile
$arraySource = [
  'first' => 'rubeus',
  'last' => 'pants',
  'company' => 'derp inc',
  'wizard_phone' => '1234567890',
  'street' => '1234 street lane',
  'city' => 'citysville',
  'state' => 'stateland',
  'zip' => 66666,
  'country' => 'back in the ussr'
];

$map = [
  'first' => 'first_name',
  'last' => 'last_name',
  'wizard_phone' => 'phone_number'
];

$card = new CreditCard(4007000000027, 123, '2019-04'); // visa testing number
$address = new Address($arraySource, $map);
$result = AuthorizeNet::createCustomerPaymentProfile($customer, $card, $address);
$payment_profile = $result->customerPaymentProfileId;
    
// authorize
$amount = 30.50;
$result = AuthorizeNet::authorize($amount, $customer, $payment_profile, 'yer-an-invoice-harry');
$transaction_id = $result->transactionId;

// capture
$result = AuthorizeNet::capture($amount, $transaction_id);
```
