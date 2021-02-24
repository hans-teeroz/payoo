<?php

namespace Omnipay\Payoo\Message;

use Omnipay\Common\Message\ResponseInterface;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function getCurrency()
    {
        // only works for VND
        return 'VND';
    }

    public function getShopDomain()
    {
        return $this->getParameter('shopDomain');
    }

    public function setShopDomain($shopDomain)
    {
        return $this->setParameter('shopDomain', $shopDomain);
    }

    public function getShopTitle()
    {
        return $this->getParameter('shopTitle');
    }

    public function setShopTitle($shopTitle)
    {
        return $this->setParameter('shopTitle', $shopTitle);
    }

    public function getPartnerCode()
    {
        return $this->getParameter('partnerCode');
    }

    public function setPartnerCode($partnerCode)
    {
        return $this->setParameter('partnerCode', $partnerCode);
    }

    public function getAccessKey()
    {
        return $this->getParameter('accessKey');
    }

    public function setAccessKey($accessKey)
    {
        return $this->setParameter('accessKey', $accessKey);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($secretKey)
    {
        return $this->setParameter('secretKey', $secretKey);
    }

    public function getApiUsername()
    {
        return $this->getParameter('apiUsername');
    }

    public function setApiUsername($apiUsername)
    {
        return $this->setParameter('apiUsername', $apiUsername);
    }

    public function getApiPassword()
    {
        return $this->getParameter('apiPassword');
    }

    public function setApiPassword($apiPassword)
    {
        return $this->setParameter('apiPassword', $apiPassword);
    }

    public function getApiSignature()
    {
        return $this->getParameter('apiSignature');
    }

    public function setApiSignature($apiSignature)
    {
        return $this->setParameter('apiSignature', $apiSignature);
    }

    public function setValidityTime($validityTime)
    {
        return $this->setParameter('validityTime', $validityTime);
    }

    public function getValidityTime()
    {
        return $this->getParameter('validityTime');
    }

    public function setOrderShipDate($orderShipDate)
    {
        return $this->setParameter('orderShipDate', $orderShipDate);
    }

    public function getOrderShipDate()
    {
        return $this->getParameter('orderShipDate');
    }

    public function getEndpoint()
    {
        $endpoint = 'https://www.payoo.vn/v2/paynow/';
        if ($this->getTestMode())
            $endpoint = 'https://newsandbox.payoo.com.vn/v2/paynow/';

        return $endpoint;
    }

    public function getBizEndpoint()
    {
        $endpoint = 'https://business.payoo.com.vn/BusinessRestAPI.svc';
        if ($this->getTestMode())
            $endpoint = 'https://bizsandbox.payoo.com.vn/BusinessRestAPI.svc';

        return $endpoint;
    }
}
