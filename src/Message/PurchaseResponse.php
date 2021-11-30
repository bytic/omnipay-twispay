<?php

namespace Paytic\Omnipay\Twispay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Paytic\Omnipay\Common\Message\Traits\RedirectHtmlTrait;

/**
 * Class PurchaseResponse
 * @package Paytic\Omnipay\Twispay\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    use RedirectHtmlTrait;

    /**
     * @param $data
     * @return mixed
     */
    protected function filterRedirectData($data)
    {
        unset($data['redirectUrl']);
        return $data;
    }
}
