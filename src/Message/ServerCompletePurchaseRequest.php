<?php

namespace Paytic\Omnipay\Twispay\Message;

use Paytic\Omnipay\Twispay\Message\Traits\CompletePurchaseRequestTrait;

/**
 * Class PurchaseResponse
 * @package ByTIC\Common\Payments\Gateways\Providers\AbstractGateway\Messages
 */
class ServerCompletePurchaseRequest extends AbstractRequest
{
    use CompletePurchaseRequestTrait;
}
