<?php

declare(strict_types=1);

use Nip\Utility\Http;
use Paytic\Omnipay\Twispay\Gateway;

// phpinfo();
// die('++');

require 'init.php';

$gateway = new Gateway();
$gateway->setTestMode(true);
// $gateway->setTestMode(false);

$basePath = dirname(Http::getCurrentUrl());
$returnUrl = $basePath . '/return.php';
// $returnUrl = 'https://webhook.site/d22dbee4-6d8b-49ae-89b8-e1c7f210009c';

$parameters = [
    'siteId' => $_ENV['TWISPAY_SITE_ID'],
    'apiKey' => $_ENV['TWISPAY_API_KEY'],
    'orderId' => uniqid('ord_'),
    'description' => 'Test order',
    'returnUrl' => $returnUrl,
    'amount' => 120.34,
    'currency' => 'ron',
    'card' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'country' => 'US',
        'state' => 'NY',
        'city' => 'New York',
        'address1' => '1st Street',
        'zipcode' => '11222',
        'phone' => '+402120000000',
        'email' => 'john.doe@gmail.com',
    ],
];

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
