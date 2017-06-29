<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationResponseTrait;
use ByTIC\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;

/**
 * Class PurchaseResponse
 * @package BByTIC\Omnipay\Twispay\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use GatewayNotificationResponseTrait;
    use ConfirmHtmlTrait;

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
