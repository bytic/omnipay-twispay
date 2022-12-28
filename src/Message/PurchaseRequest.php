<?php

declare(strict_types=1);

namespace Paytic\Omnipay\Twispay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Paytic\Omnipay\Twispay\Utility\TwispayEncoder;
use Paytic\Omnipay\Twispay\Utility\TwispayOrderType;
use Paytic\Omnipay\Twispay\Utility\TwispayTransactionMode;

/**
 * Class PurchaseRequest.
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        $parameters['orderType'] ??= TwispayOrderType::PURCHASE;
        $parameters['cardTransactionMode'] ??= TwispayTransactionMode::AUTH_AND_CAPTURE;

        return parent::initialize($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $data['redirectUrl'] = $this->getSecureUrl();

        return parent::sendData($data);
    }

    /**
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->guardValidRequest();

        $orderData = $this->buildData();

        return [
            'jsonRequest' => TwispayEncoder::getBase64JsonRequest($orderData),
            'checksum' => TwispayEncoder::getBase64Checksum($orderData, $this->getApiKey()),
        ];
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

    public function getCardTransactionMode()
    {
        return $this->getParameter('cardTransactionMode');
    }

    /**
     * @return mixed
     */
    public function getChecksum()
    {
        return $this->getParameter('checksum');
    }

    /**
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderType($value)
    {
        return $this->setParameter('orderType', $value);
    }

    public function setCardTransactionMode($value)
    {
        return $this->setParameter('cardTransactionMode', $value);
    }

    /**
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }

    /**
     * @return void
     */
    protected function guardValidRequest()
    {
        $this->validate(
            'siteId',
            'apiKey',
            'amount',
            'currency',
            'description',
            'orderId',
//            'notifyUrl',
            'returnUrl',
            'card'
        );
    }

    protected function buildData(): array
    {
        $card = $this->getCard();

        $data = [
            'siteId' => (int)$this->getSiteId(),
            'customer' => $this->buildDataCustomer($card),
            'order' => $this->buildDataOrder(),
            'cardTransactionMode' => $this->getCardTransactionMode(),
            'invoiceEmail' => $card->getEmail(),
            'backUrl' => $this->getReturnUrl(),
        ];

        return $data;
    }

    protected function buildDataCustomer($card): array
    {
        $data = [
            'identifier' => sha1($card->getEmail()),
            'firstName' => $card->getBillingFirstName() ?: '',
            'lastName' => $card->getBillingLastName() ?: '',
            'country' => $card->getBillingCountry() ?: '',
            'state' => $card->getBillingState() ?: '',
            'city' => $card->getBillingCity() ?: '',
            'address' => $card->getBillingAddress1() ?: '',
            'zipCode' => $card->getBillingPostcode() ?: '',
            'phone' => $card->getBillingPhone() ?: '',
            'email' => $card->getEmail() ?: '',
        ];

        return $data;
    }

    protected function buildDataOrder(): array
    {
        $data = [
            'orderId' => $this->getOrderId(),
            'type' => $this->getOrderType(),
            'amount' => (float)$this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
        ];

        return $data;
    }
}
