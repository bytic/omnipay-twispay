<?php

namespace ByTIC\Omnipay\Twispay\Message;

use ByTIC\Omnipay\Twispay\Helper;
use Guzzle\Http\Exception\ClientErrorResponseException;

/**
 * PayU Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        return [
            'siteId' => $this->getSiteId(),
            'identifier' => $this->getIdentifier(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
            'orderType' => $this->getOrderType(),
            'orderId' => $this->getOrderId(),
            'checksum' => $this->getChecksum(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function sendData($data)
    {
        $postData = $this->getData();
        $postData['checksum'] = Helper::generateChecksun($postData, $this->getApiKey());
        try {
            $httpResponse = $this->post(
                $this->endpoint,
                null,
                $postData,
                $this->getParameters()
            )->send();
        } catch (ClientErrorResponseException $e) {
            return $this->response = new PurchaseResponse($this, $e->getResponse()->json());
        }
        return $this->response = new PurchaseResponse($this, (string)$httpResponse->getBody());
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
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->getParameter('identifier');
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
     * @return mixed
     */
    public function getOrderType()
    {
        return $this->getParameter('orderType');
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
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setChecksum($value)
    {
        return $this->setParameter('checksum', $value);
    }

    /**
     * @return mixed
     */
    public function getChecksum()
    {
        return $this->getParameter('checksum');
    }
}
