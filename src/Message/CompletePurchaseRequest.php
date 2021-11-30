<?php

namespace Paytic\Omnipay\Twispay\Message;

use Paytic\Omnipay\Twispay\Message\Traits\CompletePurchaseRequestTrait;

/**
 * Class PurchaseResponse
 * @package Paytic\Omnipay\Twispay\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use CompletePurchaseRequestTrait;
}
