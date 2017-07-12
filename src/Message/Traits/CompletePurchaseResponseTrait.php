<?php

namespace ByTIC\Omnipay\Twispay\Message\Traits;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;

/**
 * Trait CompletePurchaseResponseTrait
 * @package ByTIC\Omnipay\Twispay\Message\Traits
 */
trait CompletePurchaseResponseTrait
{
    use GatewayNotificationResponseTrait;

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        if ($this->hasNotificationDataItem('status')
            && $this->getNotificationDataItem('status') == 'complete-ok'
        ) {
            return true;
        }
        if ($this->hasNotificationDataItem('transactionStatus')
            && $this->getNotificationDataItem('transactionStatus') == 'complete-ok'
        ) {
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
        if ($this->hasNotificationDataItem('transactionStatus')
            && $this->getNotificationDataItem('transactionStatus') == 'in-progress'
        ) {
            return true;
        }
        return parent::isPending();
    }
}
