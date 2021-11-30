<?php

namespace Paytic\Omnipay\Twispay\Tests\Message;

use Omnipay\Common\Http\Client;
use Paytic\Omnipay\Twispay\Message\PurchaseRequest;
use Paytic\Omnipay\Twispay\Message\PurchaseResponse;
use Paytic\Omnipay\Twispay\Tests\AbstractTest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class PurchaseRequestTest
 * @package Paytic\Omnipay\Twispay\Tests\Message
 */
class PurchaseRequestTest extends AbstractTest
{
    public function testSend()
    {
        $class = $this->newPurchaseRequest();
        $data = [
            'siteId' => 11111,
            'apiKey' => 22222,
            'amount' => 123.0,
            'currency' => 'RON',
            'description' => 'lorem ipsum',
            'orderId' => 123,
            'notifyUrl' => 123,
            'returnUrl' => 123,
            'card' => [
                'firstName' => 'Example',
                'lastName' => 'User'
            ],
        ];
        $class->initialize($data);
        $response = $class->send();
        self::assertInstanceOf(PurchaseResponse::class, $response);
        foreach (['siteId', 'orderId', 'description'] as $key) {
            self::assertTrue($response->hasDataProperty($key), "Property [" . $key . "] not defined");
            self::assertSame($data[$key], $response->getDataProperty($key));
        }
    }

    public function testSendIdentifierAutoSet()
    {
        $class = $this->newPurchaseRequest();
        $data = [
            'siteId' => 11111,
            'apiKey' => 22222,
            'amount' => 123.0,
            'currency' => 'RON',
            'description' => 'lorem ipsum',
            'orderId' => 123,
            'notifyUrl' => 123,
            'returnUrl' => 123,
            'card' => [
                'firstName' => 'Example',
                'lastName' => 'User'
            ],
        ];
        $class->initialize($data);
        $response = $class->send();
        self::assertInstanceOf(PurchaseResponse::class, $response);
        self::assertStringStartsWith('anonymous', $response->getDataProperty('identifier'));
    }

    /**
     * @return PurchaseRequest
     */
    protected function newPurchaseRequest()
    {
        $client = new Client();
        $request = HttpRequest::createFromGlobals();
        $request = new PurchaseRequest($client, $request);
        return $request;
    }
}
