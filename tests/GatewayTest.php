<?php

namespace Paytic\Omnipay\Twispay\Tests;

use Paytic\Omnipay\Twispay\Gateway;

/**
 * Class HelperTest
 * @package Paytic\Omnipay\Twispay\Tests
 */
class GatewayTest extends AbstractTest
{
    public function testGetSecureUrl()
    {
        $gateway = new Gateway();

        // INITIAL TEST MODE IS TRUE
        self::assertEquals(
            'https://secure-stage.twispay.com',
            $gateway->getSecureUrl()
        );

        $gateway->setTestMode(true);
        self::assertEquals(
            'https://secure-stage.twispay.com',
            $gateway->getSecureUrl()
        );

        $gateway->setTestMode(false);
        self::assertEquals(
            'https://secure.twispay.com',
            $gateway->getSecureUrl()
        );
    }
}
