<?php

namespace ByTIC\Omnipay\Twispay\Tests\Message;

use ByTIC\Omnipay\Twispay\Message\PurchaseRequest;
use ByTIC\Omnipay\Twispay\Message\PurchaseResponse;
use ByTIC\Omnipay\Twispay\Tests\AbstractTest;
use Guzzle\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class PurchaseRequestTest
 * @package ByTIC\Omnipay\Twispay\Tests\Message
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
            'currency' => 123,
            'description' => 'lorem ipsum',
            'orderId' => 123,
            'notifyUrl' => 123,
            'returnUrl' => 123,
            'card' => 123,
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
            'currency' => 123,
            'description' => 'lorem ipsum',
            'orderId' => 123,
            'notifyUrl' => 123,
            'returnUrl' => 123,
            'card' => 123,
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
        $client = new HttpClient();
        $request = HttpRequest::createFromGlobals();
        $request = new PurchaseRequest($client, $request);
        return $request;
    }
}
