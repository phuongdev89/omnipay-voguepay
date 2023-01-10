<?php
/**
 * Created by phuongdev89.
 * @author  Phuong
 * @email   phuongdev89@gmail.com
 * @date    9/18/2019
 * @time    9:44 AM
 */

namespace Omnipay\Voguepay\Message\Command;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * @method static send()
 */
abstract class AbstractRequest extends BaseAbstractRequest
{

    protected $endpoint = "https://voguepay.com/api/";

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * @return mixed
     */
    public function getCommandApiToken()
    {
        return $this->getParameter('command_api_token');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setCommandApiToken($value)
    {
        return $this->setParameter('command_api_token', $value);
    }

    /**
     * @return mixed
     */
    public function getMerchant()
    {
        return $this->getParameter('merchant');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setMerchant($value)
    {
        return $this->setParameter('merchant', $value);
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->getParameter('list');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setList($value)
    {
        return $this->setParameter('list', $value);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getParameter('id');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return array
     */
    protected function getHeader()
    {
        return [
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded',
        ];
    }

    /**
     * @return mixed
     */
    public function getRef()
    {
        return time() . mt_rand(100000000, 999999999);
    }

    /**
     * @param $task
     *
     * @param $ref
     *
     * @return mixed
     */
    public function getHash($task, $ref)
    {
        return hash('sha512', $this->getCommandApiToken() . $task . $this->getEmail() . $ref);
    }

    /**
     * @param string|array $attributes
     *
     * @throws InvalidRequestException
     */
    public function validate($attributes = [])
    {
        if (!is_array($attributes)) {
            $attributes = [$attributes];
        }
        foreach ($attributes as $attr) {
            $value = $this->parameters->get($attr);
            if (!isset($value)) {
                throw new InvalidRequestException("The $attr parameter is required");
            }
        }
    }
}
