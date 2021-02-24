<?php

namespace Omnipay\Payoo\Message;

use Omnipay\Common\Message\AbstractResponse;

class QueryResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        $data = $this->getData();
        return isset($data['ResponseCode']) && $data['ResponseCode'] == 0 ? true : false;
    }

    public function isPending()
    {
        return true;
    }

    public function isRedirect()
    {
        return true;
    }

    public function isTransparentRedirect()
    {
        return true;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectUrl()
    {
        return null;
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}