<?php

namespace Omnipay\Payoo;


use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Payoo';
    }

    public function getDefaultParameters()
    {
        return [
            'shopDomain' => '',
            'shopTitle' => '',
            'partnerCode' => '',
            'accessKey' => '',
            'secretKey' => '',
            'apiUsername' => '',
            'apiPassword' => '',
            'apiSignature' => '',
            'testMode' => true,
        ];
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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payoo\Message\PurchaseRequest', $parameters);
    }

    public function query(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payoo\Message\QueryRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Payoo\Message\CompletePurchaseRequest', $parameters);
    }
}
