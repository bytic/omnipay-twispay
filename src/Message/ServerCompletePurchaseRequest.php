<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message;

use Paytic\Omnipay\Twispay\Message\Traits\CompletePurchaseRequestTrait;

/**
 * Class PurchaseResponse.
 */
class ServerCompletePurchaseRequest extends AbstractRequest
{
    use CompletePurchaseRequestTrait;
}
