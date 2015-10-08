# Budbee PHP Wrapper
This repository is a PHP wrapper of the budbee Open API. The API is used to create Order bookings at budbee.

# Installation
Add budbee-php to your ```composer.json``` file

```php
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/budbee/budbee-php"
        }
    ],
    "require": {
        "budbee/budbee-php": "*"
    }
}
```

Run ```php composer.phar install```

# Code Example

To create an Order a user needs to:
 1. Validate the delivery postalcode
 2. Request an available delivery interval.
 3. Post an Order with an accepted delivery postalcode and an acceptable delivery interval

## Setup 

Require the wrapper

```php
<?php
  require_once('vendor/autoload.php');
  
  $apiKey = '<YOUR_API_KEY>';
  $apiSecret = '<YOUR_API_SECRET>';
  
  $client = new \Budbee\Client($apiKey, $apiSecret, Budbee\Client::$SANDBOX);
  $postalCodesAPI = new \Budbee\PostalcodesApi($client);
  $intervalAPI = new \Budbee\IntervalApi($client);
  $orderAPI = new \Budbee\OrderApi($client);
?>
```

## Validate a postalcode

```php
if(!$postalCodesAPI->checkPostalCode('11453')) {
  die('Budbee does not deliver to specified Postal Code');
}
```

## Get the next upcoming delivery interval

```php
try {
    $interval = $intervalAPI->getIntervals(1)[0];
} catch (\Bubdee\BudbeeException $e) {
    die('No upcoming delivery intervals');
}

echo 'Budbee can deliver between: ' + $interval->delivery->start + ' and ' + $interval->delivery->stop;
```

## Create an order

```php
// Create Order Object
$order = new OrderRequest();
$order->interval = $interval;

// Create Cart Object
$cart = new Cart();
$cart->cartId = '12345';

// Create an Article
$article = new Article();
$article->name = 'T-Shirt';
$article->reference = '61252123';
$article->quantity = 1;
$article->unitPrice = 4900;
$article->discountRate = 0;
$article->taxRate = 2500;

$cart->articles = [$article];

$order->cart = $cart;

// Specify Delivery information
$deliveryContact = new Contact();
$deliveryContact->name = 'John Doe';
$deliveryContact->telephoneNumber = '00 123 45 67';
$deliveryContact->email = 'john.doe@budbee.com';
$deliveryContact->doorCode = '0000';
$deliveryContact->outsideDoor = true;

$deliveryAddress = new Address();
$deliveryAddress->street = 'Grevgatan 9';
$deliveryAddress->postalCode = '11453';
$deliveryAddress->city = 'Stockholm';
$deliveryAddress->country = 'SE';

$deliveryContact->address = $deliveryAddress;

$order->delivery = $deliveryContact;

$createdOrder = $orderAPI->createOrder($order);

echo 'Created Order: ';
echo json_encode($createdOrder);

```
