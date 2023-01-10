<?php

namespace Omnipay\Voguepay\Message\Gateway;

use GuzzleHttp\Exception\BadResponseException;
use Omnipay\Common\Exception\InvalidRequestException;

class TransactionRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    public function getVTransactionId()
    {
        return $this->getParameter('v_transaction_id');
    }

    /**
     * @param $value
     *
     * @return TransactionRequest
     */
    public function setVTransactionId($value)
    {
        return $this->setParameter('v_transaction_id', $value);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->getParameter('type');
    }

    /**
     * @param $value
     *
     * @return TransactionRequest
     */
    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate([
            'v_transaction_id',
            'type',
        ]);
        return [
            'v_transaction_id' => $this->getVTransactionId(),
            'type' => $this->getType(),
            'demo' => $this->getDemo(),
        ];
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     *
     * @return TransactionResponse
     */
    public function sendData($data)
    {
        try {
            $response = $this->httpClient->request('GET', $this->getEndpoint() . http_build_query($data));
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }
        $result = json_decode($response->getBody()->getContents(), true);
        return new TransactionResponse($this, $result);
    }
}
