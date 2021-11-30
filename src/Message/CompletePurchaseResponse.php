<?php

namespace Paytic\Omnipay\Twispay\Message;

use Paytic\Omnipay\Common\Message\Traits\HtmlResponses\ConfirmHtmlTrait;
use Paytic\Omnipay\Twispay\Message\Traits\CompletePurchaseResponseTrait;

/**
 * Class PurchaseResponse
 * @package BPaytic\Omnipay\Twispay\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    use ConfirmHtmlTrait;
    use CompletePurchaseResponseTrait;
}
