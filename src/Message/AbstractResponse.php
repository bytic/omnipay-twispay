<?php

namespace Paytic\Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractResponse as CommonAbstractResponse;
use Paytic\Omnipay\Common\Message\Traits\DataAccessorsTrait;

/**
 * Class Response
 * @package Paytic\Omnipay\Twispay\Message
 */
abstract class AbstractResponse extends CommonAbstractResponse
{
    use DataAccessorsTrait;

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        return
            isset($this->data['success'])
            && $this->data['success'];
    }
}
