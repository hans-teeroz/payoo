<?php

namespace Omnipay\Payoo\Message;

class PurchaseRequest extends AbstractRequest
{
    const TIME_ZONE = 'Asia/Ho_Chi_Minh';
    public function getData()
    {
        $this->validate(
            'shopTitle',
            'shopDomain',
            'accessKey',
            'secretKey',
            'partnerCode',
            'transactionId',
            'returnUrl',
            'notifyUrl',
            'amount',
            'description'
        );

        $order = $this->buildOrderXml();
        $secretKey = $this->getSecretKey();

        return [
            'data' => $order,
            'checksum' => hash('sha512', $secretKey . $order),
            'refer' => $this->getShopDomain(),
        ];
    }

    public function sendData($data)
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint() . '/order/create', [
            'Content-Type' => 'application/json',
        ], json_encode($data));
        $responseData = $response->getBody()->getContents();
        return new PurchaseResponse($this, json_decode($responseData, true));
    }

    protected function buildOrderXml()
    {
        $orderShipDate = $this->getOrderShipDate() ? $this->getOrderShipDate() : new \DateTime('today');
        $orderShipDate = $orderShipDate->format('d/m/Y');

        $validityTime = $this->getValidityTime() ? $this->getValidityTime() : new \DateTime('+24 hours');
        $validityTime = $validityTime->format('YmdHis');

        return '<shops><shop>' .
            '<session>' . $this->getTransactionId() . '</session>' .
            '<username>' . $this->getAccessKey() . '</username>' .
            '<shop_id>' . $this->getPartnerCode() . '</shop_id>' .
            '<shop_title>' . $this->getShopTitle() . '</shop_title>' .
            '<shop_domain>' . $this->getShopDomain() . '</shop_domain>' .
            '<shop_back_url>' . $this->getReturnUrl() . '</shop_back_url>' .
            '<order_no>' . $this->getTransactionId() . '</order_no>' .
            '<order_cash_amount>' . $this->getAmountInteger() . '</order_cash_amount>' .
            '<order_ship_date>' . $orderShipDate . '</order_ship_date>' .
            '<order_ship_days>' . 0 . '</order_ship_days>' .
            '<order_description>' . urlencode($this->getDescription()) . '</order_description>' .
            '<validity_time>' . $validityTime . '</validity_time>' .
            '<notify_url>' . $this->getNotifyUrl() . '</notify_url>' .
            '<customer>' .
            '<name>' . $this->getCard()->getName() . '</name>' .
            '<phone>' . $this->getCard()->getNumber() . '</phone>' .
            '<email>' . $this->getCard()->getEmail() . '</email>' .
            '</customer>' .
            '</shop></shops>';
    }
}
