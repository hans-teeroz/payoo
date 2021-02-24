<?php

namespace Omnipay\Payoo\Message;

class QueryRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate(
            'apiUsername',
            'apiPassword',
            'apiSignature',
            'partnerCode',
            'transactionId'
        );

        $secretKey = $this->getSecretKey();

        return [
            'OrderId' => $this->getTransactionId(),
            'ShopId' => $this->getPartnerCode()
        ];
    }

    public function sendData($data)
    {
        /*$endpoint = $this->getBizEndpoint();

        $body     = json_encode($data);
        $response = $this->httpClient->request('POST', $endpoint . '/GetOrderInfo', [
            'verify' => false,
            'APIUsername' => $this->getApiUsername(),
            'APIPassword' => $this->getApiPassword(),
            'APISignature' => $this->getApiSignature(),
            'Content-Type' => 'application/json',
        ], $body)->getBody();
        $result  = json_decode($response, true);*/

        $order = json_encode($data);
        $headers = [
            'APIUsername: ' . $this->getApiUsername(),
            'APIPassword: ' . $this->getApiPassword(),
            'APISignature: ' . $this->getApiSignature(),
            'Content-Type: application/json'
        ];

        $signature = hash('sha512', $this->getSecretKey() . $order);
        $body = json_encode([
            'RequestData' => $order,
            'Signature' => $signature
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->getBizEndpoint() . '/GetOrderInfo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => $headers
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        $result = json_decode($data['ResponseData'], true);

        return $this->response = new QueryResponse($this, $result);
    }
}