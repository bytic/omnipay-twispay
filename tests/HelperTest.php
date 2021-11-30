<?php

namespace Paytic\Omnipay\Twispay\Tests;

use Paytic\Omnipay\Twispay\Helper;

/**
 * Class HelperTest
 * @package Paytic\Omnipay\Twispay\Tests
 */
class HelperTest extends AbstractTest
{
    public function testGenerateChecksum()
    {
        $data = ['test' => 1, 'test5' => 2];
        self::assertEquals(
            'bV+EPPOaxuut0IjVdAyOFSg0/j38gxT6C/RIxmF8yTD4ZzlHL5xFI62JiOeSByYlADWkSEi/u/nszcjFgXvk6A==',
            Helper::generateChecksum($data, '23112345654689897')
        );
    }
}
