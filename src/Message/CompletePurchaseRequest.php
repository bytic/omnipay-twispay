<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Twispay\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait;

    /**
     * @return mixed
     */
    protected function isProviderRequest()
    {
        return $this->hasGet('id') && $this->hasPOST('opensslResult');
    }
}
