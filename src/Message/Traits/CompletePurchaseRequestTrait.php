<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message\Traits;

use Paytic\Omnipay\Common\Message\Traits\GatewayNotificationRequestTrait;
use Paytic\Omnipay\Twispay\Utility\TwispayDecoder;

/**
 * Trait CompletePurchaseRequestTrait.
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

        $json = TwispayDecoder::decrypt($dataResult, $this->getApiKey());
        $data = json_decode($json, true);

        return $data;
    }

    /**
     * @return mixed
     */
    public function isValidNotification()
    {
        return $this->hasPOST('opensslResult') || $this->hasPOST('result');
    }
}
