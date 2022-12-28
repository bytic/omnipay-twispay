<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message;

use Paytic\Omnipay\Twispay\Message\Traits\CompletePurchaseResponseTrait;

/**
 * Class PurchaseResponse.
 */
class ServerCompletePurchaseResponse extends AbstractResponse
{
    use CompletePurchaseResponseTrait;

    public function send()
    {
        echo 'OK';
    }
}
