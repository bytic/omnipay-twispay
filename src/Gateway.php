<?php

namespace ByTIC\Omnipay\Twispay;

use ByTIC\Omnipay\Twispay\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method RequestInterface authorize(array $options = [])
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface capture(array $options = [])
 * @method RequestInterface completePurchase(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 */
class Gateway extends AbstractGateway
{

    /**
     * @var string
     */
    private $privateKey = '';

    /**
     * @var int
     */
    private $siteId = 0;

    /**
     * @var string
     */
    private $testApiHost = 'https://api-stage.twispay.com';

    /**
     * @var string
     */
    private $prodApiHost = 'https://api.twispay.com';

    /**
     * @var string
     */
    private $testSecureHost = 'https://secure-stage.twispay.com';

    /**
     * @var string
     */
    private $prodSecureHost = 'https://secure.twispay.com';

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Twispay';
    }

    // ------------ Requests ------------ //

    /**
     * @inheritdoc
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        $parameters['apiUrl'] = $this->getSecureUrl();

        return $this->createRequest(
            PurchaseRequest::class,
            array_merge($this->getDefaultParameters(), $parameters)
        );
    }

    // ------------ Getter'n'Setters ------------ //

    /**
     * Get live- or testURL.
     */
    public function getSecureUrl()
    {
        $defaultUrl = $this->getTestMode() === false
            ? $this->prodSecureHost
            : $this->testSecureHost;
        return $this->parameters->get('secureUrl', $defaultUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'testMode' => true, // Must be the 1st in the list!
            'siteId' => $this->getSiteId(),
            'apiKey' => $this->getPrivateKey(),
            'apiUrl' => $this->getApiUrl(),
            'secureUrl' => $this->getSecureUrl(),
        ];
    }

    /**
     *
     * @return string
     */
    public function getSiteId()
    {
        return $this->parameters->get('siteId', $this->siteId);
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSiteId($value)
    {
        return $this->setParameter('siteId', $value);
    }

    /**
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->parameters->get('apiKey', $this->privateKey);
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get live- or testURL.
     */
    public function getApiUrl()
    {
        $defaultUrl = $this->getTestMode() === false
            ? $this->prodApiHost
            : $this->testApiHost;
        return $this->parameters->get('apiUrl', $defaultUrl);
    }

    /**
     * @param $value
     * @return $this
     */
    public function setApiUrl($value)
    {
        return $this->setParameter('apiUrl', $value);
    }
}
