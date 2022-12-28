<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Tests\Message;

use Paytic\Omnipay\Twispay\Message\CompletePurchaseRequest;

/**
 *
 */
class CompletePurchaseRequestTest extends AbstractRequestTest
{
    public const REQUEST_VALID = TEST_FIXTURE_PATH . '/requests/valid/data.php';

    public function testIsValidNotification()
    {
        $request = $this->newCompletePurchaseRequest();
        self::assertFalse($request->isValidNotification());

        $request = $this->newCompletePurchaseRequest(self::REQUEST_VALID);
        self::assertTrue($request->isValidNotification());
    }

    /**
     * @return CompletePurchaseRequest
     */
    protected function newCompletePurchaseRequest($fixtures = null)
    {
        return $this->newRequestFromFixtures(CompletePurchaseRequest::class, $fixtures);
    }

    public function testGetDataValid()
    {
        $data = require self::REQUEST_VALID;
        $request = $this->newCompletePurchaseRequest($data);
        $data = $request->getData();
        self::assertSame($data['notification'], $data['notification']);
    }
}
