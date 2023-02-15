# [DEPRECATED] Budbee PHP Wrapper

> **Warning**
> This project is deprecated and should not be used for integrating with Budbee API.

---

This repository is a PHP wrapper of the budbee Open API. The API is used to create Order bookings at budbee.

# Installation
Add budbee-php to your `composer.json` file

```php
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/budbee/budbee-php"
        }
    ],
    "require": {
        "budbee/api-client": "dev-master"
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
  $boxesAPI = new \Budbee\BoxesApi($client);
  $intervalAPI = new \Budbee\IntervalApi($client);
  $orderAPI = new \Budbee\OrderApi($client);
?>
```

## Validate a postalcode

```php
try {
    $possibleCollectionPoints = $postalCodesAPI->checkPostalCode('SE', '11453');
} catch (\Budbee\Exception\BudbeeException $e) {
    die('Budbee does not deliver to specified Postal Code');
}
```

## Get available boxes (lockers)

```php
try {
    $availableBoxes = $boxesAPI->getBoxes('SE', '11453');
} catch (\Budbee\Exception\BudbeeException $e) {
    die('No boxes were found for specified Postal Code');
}
```

## Get upcoming delivery intervals

```php
try {
    $intervalResponse = $intervalAPI->getIntervals($deliveryAddress->country, $deliveryAddress->postalCode, 2);
} catch (\Budbee\Exception\BudbeeException $e) {
    die('No upcoming delivery intervals');
}

$firstInterval = $intervalResponse[0];
$interval = new \Budbee\Model\OrderInterval($firstInterval->collection, $firstInterval->delivery);
$collectionPointId = $firstInterval->collectionPointId;

echo 'Budbee can deliver between: ' + $interval->delivery->start + ' and ' + $interval->delivery->stop;

```

## Create an order

```php
// Create Order Object
$order = new \Budbee\Model\OrderRequest();
$order->interval = $interval;
$order->collectionId = $collectionPointId;

// Create Cart Object
$cart = new \Budbee\Model\Cart();
$cart->cartId = '12345';

// Create an Article
$article = new \Budbee\Model\Article();
$article->name = 'T-Shirt';
$article->reference = '61252123';
$article->quantity = 1;
$article->unitPrice = 4900;
$article->discountRate = 0;
$article->taxRate = 2500;

$cart->articles = [$article];

$order->cart = $cart;

// Specify Delivery information
$deliveryContact = new \Budbee\Model\Contact();
$deliveryContact->name = 'John Doe';
$deliveryContact->telephoneNumber = '00 123 45 67';
$deliveryContact->email = 'john.doe@budbee.com';
$deliveryContact->doorCode = '0000';
$deliveryContact->outsideDoor = true;

$deliveryAddress = new \Budbee\Model\Address();
$deliveryAddress->street = 'Grevgatan 9';
$deliveryAddress->postalCode = '11453';
$deliveryAddress->city = 'Stockholm';
$deliveryAddress->country = 'SE';

$deliveryContact->address = $deliveryAddress;

$order->delivery = $deliveryContact;

$createdOrder = $orderAPI->createOrder($order);

echo 'Created Order';
```

# Edit the delivery contact of an order

```php
$order = $orderAPI->createOrder($data);
$deliveryContact = $order->delivery;
$deliveryContact->name = 'Jane Doe';

$updatedOrder = $orderAPI->editDeliveryContact($order->id, $deliveryContact);
```
