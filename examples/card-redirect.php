<?php

require 'init.php';

$gateway = new \ByTIC\Omnipay\Twispay\Gateway();
$parameters = [
    'siteId' => $_ENV['TWISPAY_SITE_ID'],
    'apiKey' => $_ENV['TWISPAY_API_KEY'],
    'orderId' => 99999,
    'amount' => 20.00,
    'currency' => 'ron',
    'card' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@gmail.com',
    ],
];

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
