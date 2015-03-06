<?php
require_once("vendor/autoload.php");

function sanitizeForSerialization($data) {
    if (is_scalar($data) || null == $data) {
        $sanitized = $data;
    } else if ($data instanceof \DateTime) {
        $sanitized = $data->format('U') * 1000;
    } else if (is_array($data)) {
        foreach ($data as $property => $value) {
            $data[$property] = sanitizeForSerialization($value);
        }
        $sanitized = $data;
    } else if (is_object($data)) {
        $values = array();
        foreach (array_keys($data::$dataTypes) as $property) {
            $values[$property] = sanitizeForSerialization($data->$property);
        }
        $sanitized = $values;
    } else {
        $sanitized = (string) $data;
    }

    return $sanitized;
}

$apiKey = "b84c6f43-1548-4107-a5bb-3cba9dd7d8f0";
$secretKey = "3f18d3ec-f2be-4824-8c64-6ebe21b8bc53f0dce2e1-3da0-43e9-8377-1c2268edfb9a";
$env = 1 < $_SERVER["argc"] ? $_SERVER["argv"][1] : Budbee\Client::$DEVELOPMENT;

$client = new Budbee\Client($apiKey, $secretKey, $env);
$intervalApi = new Budbee\IntervalApi($client);
$orderApi = new Budbee\OrderApi($client);

$interval = $intervalApi->getIntervals(1)[0];

$cart = new Budbee\Model\Cart;
$cart->cartId = "123456";

$article = new Budbee\Model\Article;
$article->name = "T-Shirt";
$article->reference = "123456789";
$article->quantity = 4;
$article->unitPrice = 4900;
$article->discountRate = 0;
$article->taxRate = 2500;

$dimensions = new Budbee\Model\Dimensions;
$dimensions->width = 150;
$dimensions->length = 70;
$dimensions->height = 50;
$dimensions->weight = 5000;

$address = new Budbee\Model\Address;
$address->street = "Grevgatan 9";
$address->postalCode = "11453";
$address->city = "Stockholm";
$address->country = "SE";

$delivery = new Budbee\Model\Contact;
$delivery->name = "Axel Möller";
$delivery->referencePerson = "";
$delivery->telephoneNumber = "0706019392";
$delivery->email = "axel.moller@budbee.com";
$delivery->doorCode = "8912";
$delivery->outsideDoor = true;

$order = new Budbee\Model\Order;
$order->interval = $interval;
$order->cart = $cart;
$order->cart->articles = array($article);
$order->dimensions = $dimensions;
$order->delivery = $delivery;
$order->delivery->address = $address;

$orderArr = array($order);

$orders = $orderApi->createOrder($orderArr);

echo json_encode(sanitizeForSerialization($orders)), "\n";
