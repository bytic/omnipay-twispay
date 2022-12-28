<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message;

use Omnipay\Common\Message\AbstractRequest as CommonAbstractRequest;
use Paytic\Omnipay\Common\Message\Traits\SendDataRequestTrait;

/**
 * Class AbstractRequest.
 */
abstract class AbstractRequest extends CommonAbstractRequest
{
    use SendDataRequestTrait;

    /**
     * @return mixed
     */
    public function getSiteId()
    {
        return $this->getParameter('siteId');
    }

    /**
     * @return CommonAbstractRequest
     */
    public function setSiteId($value)
    {
        return $this->setParameter('siteId', $value);
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @return CommonAbstractRequest
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', (string)$value);
    }

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->getParameter('apiUrl');
    }

    /**
     * @return CommonAbstractRequest
     */
    public function setApiUrl($value)
    {
        return $this->setParameter('apiUrl', $value);
    }

    /**
     * @return mixed
     */
    public function getSecureUrl()
    {
        return $this->getParameter('secureUrl');
    }

    /**
     * @return CommonAbstractRequest
     */
    public function setSecureUrl($value)
    {
        return $this->setParameter('secureUrl', $value);
    }
}
