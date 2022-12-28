<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;
use Paytic\Omnipay\Common\Message\Traits\DataAccessorsTrait;

/**
 * Class Response.
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
    use DataAccessorsTrait;

    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return
            isset($this->data['success'])
            && $this->data['success'];
    }
}
