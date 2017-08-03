<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Common\Message\Traits\RedirectHtmlTrait;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Twispay\Message
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
