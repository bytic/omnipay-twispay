<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Tests\Message;

use Omnipay\Common\Http\Client;
use Paytic\Omnipay\Twispay\Message\AbstractRequest;
use Paytic\Omnipay\Twispay\Tests\AbstractTest;

/**
 *
 */
abstract class AbstractRequestTest extends AbstractTest
{
    /**
     * @return AbstractRequest
     */
    protected function newRequestFromFixtures($class, $fixtures = null)
    {
        $client = new Client();
        $request = $this->createHttpRequestFromFixtures($fixtures);
        /** @var AbstractRequest $request */
        $request = new $class($client, $request);
        $request->setApiKey($_ENV['TWISPAY_API_KEY'] ?? null);

        return $request;
    }
}
