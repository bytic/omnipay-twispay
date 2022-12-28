<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;
use Paytic\Omnipay\Common\Message\Traits\RedirectHtmlTrait;

/**
 * Class PurchaseResponse.
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    use RedirectHtmlTrait;

    /**
     * @return mixed
     */
    protected function filterRedirectData($data)
    {
        unset($data['redirectUrl']);

        return $data;
    }
}
