<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Twispay\Message\Traits\CompletePurchaseResponseTrait;

/**
 * Class PurchaseResponse
 * @package ByTIC\Common\Payments\Gateways\Providers\AbstractGateway\Messages
 */
class ServerCompletePurchaseResponse extends AbstractResponse
{
    use CompletePurchaseResponseTrait;

    public function send()
    {
        echo 'OK';
    }
}
