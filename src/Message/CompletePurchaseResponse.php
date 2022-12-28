<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message;

use Paytic\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;
use Paytic\Omnipay\Twispay\Message\Traits\CompletePurchaseResponseTrait;

/**
 * Class PurchaseResponse.
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use CompletePurchaseResponseTrait;
    use ConfirmHtmlTrait;
}
