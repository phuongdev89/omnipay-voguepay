<?php
/**
 * Created by phuongdev89.
 * @author  Phuong
 * @email   phuongdev89@gmail.com
 * @date    9/18/2019
 * @time    10:06 AM
 */

namespace Omnipay\Voguepay\Message\Command;

use GuzzleHttp\Exception\BadResponseException;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Voguepay\CommandGateway;

class FetchRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->getParameter('quantity');
    }

    /**
     * @param $value
     *
     * @return FetchRequest
     */
    public function setQuantity($value)
    {
        return $this->setParameter('quantity', $value);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getParameter('status');
    }

    /**
     * @param $value
     *
     * @return FetchRequest
     */
    public function setStatus($value)
    {
        return $this->setParameter('status', $value);
    }

    /**
     * @return mixed
     */
    public function getBuyer()
    {
        return $this->getParameter('buyer');
    }

    /**
     * @param $value
     *
     * @return FetchRequest
     */
    public function setBuyer($value)
    {
        return $this->setParameter('buyer', $value);
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->getParameter('time');
    }

    /**
     * @param $value
     *
     * @return FetchRequest
     */
    public function setTime($value)
    {
        return $this->setParameter('time', $value);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate([
            'merchant',
            'email',
            'command_api_token',
        ]);
        $task = CommandGateway::API_FETCH;
        $ref = $this->getRef();
        $hash = $this->getHash($task, $ref);
        return [
            'task' => $task,
            'merchant' => $this->getMerchant(),
            'ref' => $ref,
            'hash' => $hash,
            'list' => $this->getList(),
            'id' => $this->getId(),
            'quantity' => $this->getQuantity(),
            'status' => $this->getStatus(),
            'buyer' => $this->getBuyer(),
            'time' => $this->getTime(),
        ];
    }

    /**
     * Send the request with specified data
     *
     * @param mixed $data The data to send
     *
     * @return AbstractResponse|FetchResponse
     */
    public function sendData($data)
    {
        $data = array_filter($data);
        $field = 'json=' . urlencode(json_encode($data));
        try {
            $response = $this->httpClient->request('POST', $this->getEndpoint(), $this->getHeader(), $field);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }
        $content = str_replace("\xEF\xBB\xBF", "", (string)$response->getBody()->getContents());
        $result = json_decode($content, true);
        return new FetchResponse($this, $result);
    }
}
