<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Twispay\Helper;

/**
 * Class PurchaseRequest
 * @package ByTIC\Omnipay\Twispay\Message
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
{

    /**
     * @inheritdoc
     */
    public function initialize(array $parameters = [])
    {
        $parameters['orderType'] = isset($parameters['orderType']) ? $parameters['orderType'] : 'purchase';

        $parameters['identifier'] = isset($parameters['identifier']) ?
            $parameters['identifier'] : 'anonymous'.microtime(true);

        return parent::initialize($parameters);
    }

    /**
     * @inheritdoc
     */
    public function sendData($data)
    {
        $data['checksum'] = Helper::generateChecksum($data, $this->getApiKey());
        $data['redirectUrl'] = $this->getSecureUrl();

        return parent::sendData($data);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'siteId', 'apiKey', 'amount', 'currency', 'description', 'orderId', 'notifyUrl', 'returnUrl', 'card'
        );

        $data = [
//            'apiKey' => $this->getSiteId(),
//            'notifyUrl' => $this->getNotifyUrl(),
            'siteId' => $this->getSiteId(),
            'backUrl' => $this->getReturnUrl(),
            'identifier' => $this->getIdentifier(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'orderType' => $this->getOrderType(),
            'orderId' => $this->getOrderId(),
//            'checksum' => $this->getChecksum(),
        ];

        $card = $this->getCard();

        $data['firstName'] = $card->getBillingFirstName();
        $data['lastName'] = $card->getBillingLastName();
        $data['address'] = $card->getBillingAddress1();
        $data['phone'] = $card->getBillingPhone();
        $data['email'] = $card->getEmail();
        $data['invoiceEmail'] = $card->getEmail();

        return $data;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->getParameter('identifier');
    }

    /**
     * @return mixed
     */
    public function getOrderType()
    {
        return $this->getParameter('orderType');
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    /**
     * @return mixed
     */
    public function getChecksum()
    {
        return $this->getParameter('checksum');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setIdentifier($value)
    {
        return $this->setParameter('identifier', $value);
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderType($value)
    {
        return $this->setParameter('orderType', $value);
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setChecksum($value)
    {
        return $this->setParameter('checksum', $value);
    }
}
