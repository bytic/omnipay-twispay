<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;

/**
 * Class PurchaseResponse
 * @package ByTIC\Common\Payments\Gateways\Providers\AbstractGateway\Messages
 */
class ServerCompletePurchaseResponse extends AbstractResponse
{
    use GatewayNotificationResponseTrait;

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        if ($this->hasNotificationDataItem('status') && $this->getNotificationDataItem('status') == 'complete-ok') {
            return true;
        }
        return parent::isSuccessful();
    }

    /**
     * @inheritdoc
     */
    public function isPending()
    {
        if ($this->hasNotificationDataItem('status') && $this->getNotificationDataItem('status') == 'in-progress') {
            return true;
        }
        return parent::isPending();
    }
}
