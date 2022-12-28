<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message\Traits;

use Paytic\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;

/**
 * Trait CompletePurchaseResponseTrait.
 */
trait CompletePurchaseResponseTrait
{
    use GatewayNotificationResponseTrait;

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        if ($this->hasNotificationDataItem('status')
            && 'complete-ok' == $this->getNotificationDataItem('status')
        ) {
            return true;
        }
        if ($this->hasNotificationDataItem('transactionStatus')
            && 'complete-ok' == $this->getNotificationDataItem('transactionStatus')
        ) {
            return true;
        }

        return parent::isSuccessful();
    }

    /**
     * {@inheritdoc}
     */
    public function isPending()
    {
        if ($this->hasNotificationDataItem('status') && 'in-progress' == $this->getNotificationDataItem('status')) {
            return true;
        }
        if ($this->hasNotificationDataItem('transactionStatus')
            && 'in-progress' == $this->getNotificationDataItem('transactionStatus')
        ) {
            return true;
        }

        return parent::isPending();
    }
}
