<?php

namespace ByTIC\Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;

/**
 * Class Response
 * @package ByTIC\Omnipay\Twispay\Message
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
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