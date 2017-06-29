<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Common\Message\Traits\DataAccessorsTrait;
use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

/**
 * Class Response
 * @package ByTIC\Omnipay\Twispay\Message
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
    use DataAccessorsTrait;

    /**
     * @internal
     */
    public function isSuccessful()
    {
        return
            isset($this->data['success'])
            && $this->data['success'];
    }
}
