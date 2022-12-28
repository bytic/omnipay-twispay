<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Tests\Message;

use Omnipay\Common\Message\AbstractRequest;
use Paytic\Omnipay\Twispay\Message\PurchaseRequest;
use Paytic\Omnipay\Twispay\Message\PurchaseResponse;

/**
 * Class PurchaseRequestTest.
 */
class PurchaseRequestTest extends AbstractRequestTest
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
                'lastName' => 'User',
                'email' => 'test@yahoo.com',
            ],
        ];
        $class->initialize($data);
        $response = $class->send();
        self::assertInstanceOf(PurchaseResponse::class, $response);
        foreach (['jsonRequest', 'checksum'] as $key) {
            self::assertTrue($response->hasDataProperty($key), 'Property [' . $key . '] not defined');
        }
    }

    /**
     * @return PurchaseRequest|AbstractRequest
     */
    protected function newPurchaseRequest()
    {
        return $this->newRequestFromFixtures(PurchaseRequest::class);
    }
}
