<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Twispay\Helper;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Twispay\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use GatewayNotificationRequestTrait;

    /**
     * @return bool|mixed
     */
    protected function parseNotification()
    {
        $json = Helper::decrypt($this->httpRequest->request->get('opensslResult'), $this->getApiKey());
        $data = json_decode($json, true);
        return $data;
    }

    /**
     * @return mixed
     */
    protected function isValidNotification()
    {
        return $this->hasGet('id') && $this->hasPOST('opensslResult');
    }
}
