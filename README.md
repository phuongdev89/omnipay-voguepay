Omnipay for Voguepay
====================
Omnipay for Voguepay

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist navatech/omnipay-voguepay "*"
```

or add

```
"navatech/omnipay-voguepay": "*"
```

to the require section of your `composer.json` file.


Usage
-----

The following gateways are provided by this package:

* Voguepay

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Example

### Create payment url

```php
$gateway = Omnipay::create('Voguepay');

$gateway->initialize(array(
    'demo' => true,
    'v_merchant_id' => ''
));

$response = $gateway->payUrl([
    'total' => 10.00,
    'memo' => 'Payment description',
    'cur' => 'USD',
    'merchant_ref' => 'Your payment identity',
])->send();

if ($response->isSuccessful()) {
    $data = $response->getData(); 
}
```

### Get transaction detail

```php
$gateway = Omnipay::create('Voguepay');

$gateway->initialize(array(
    'demo' => true,
    'v_merchant_id' => ''
));

$response = $gateway->transaction([
    'v_transaction_id' => '9GAS78ETG',
    'type' => 'json',
])->send();

if ($response->isSuccessful()) {
    $data = $response->getData(); 
}
```
