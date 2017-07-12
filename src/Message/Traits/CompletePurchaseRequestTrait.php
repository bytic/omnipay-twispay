<?php

namespace ByTIC\Omnipay\Twispay\Message\Traits;

use ByTIC\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use ByTIC\Omnipay\Twispay\Helper;

/**
 * Trait CompletePurchaseRequestTrait
 * @package ByTIC\Omnipay\Twispay\Message\Traits
 */
trait CompletePurchaseRequestTrait
{
    use GatewayNotificationRequestTrait;

    /**
     * @return bool|mixed
     */
    protected function parseNotification()
    {
        $dataResult = $this->hasPOST('opensslResult')
            ? $this->httpRequest->request->get('opensslResult')
            : $this->httpRequest->request->get('result');

        $json = Helper::decrypt($dataResult, $this->getApiKey());
        $data = json_decode($json, true);
        return $data;
    }

    /**
     * @return mixed
     */
    protected function isValidNotification()
    {
        return $this->hasGet('id') && ($this->hasPOST('opensslResult') || $this->hasPOST('result'));
    }
}
