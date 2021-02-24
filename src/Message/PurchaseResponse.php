<?php

namespace Omnipay\Payoo\Message;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return false;
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
        return 'POST';
    }

    public function getRedirectUrl()
    {
        if (isset($this->data['order']['payment_url'])) {
            return $this->data['order']['payment_url'];
        }
        return '#';
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}
