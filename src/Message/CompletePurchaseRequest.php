<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Twispay\Message\Traits\CompletePurchaseRequestTrait;

/**
 * Class PurchaseResponse
 * @package ByTIC\Omnipay\Twispay\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use CompletePurchaseRequestTrait;
}
