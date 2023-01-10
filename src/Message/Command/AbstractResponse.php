<?php
/**
 * Created by phuongdev89.
 * @author  Phuong
 * @email   phuongdev89@gmail.com
 * @date    9/18/2019
 * @time    10:08 AM
 */

namespace Omnipay\Voguepay\Message\Command;

use Omnipay\Voguepay\CommandGateway;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{

    /**
     * @return mixed
     */
    public function getId()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        if (isset($this->data['username'])) {
            return $this->data['username'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        if (isset($this->data['salt'])) {
            return $this->data['salt'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        if (isset($this->data['hash'])) {
            return $this->data['hash'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        if (isset($this->data['list'])) {
            return $this->data['list'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        if (isset($this->data['status'])) {
            return $this->data['status'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        if (isset($this->data['response'])) {
            return $this->data['response'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        if (isset($this->data['values'])) {
            return $this->data['values'];
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        if (isset($this->data['description'])) {
            return $this->data['description'];
        }
        return false;
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return isset($this->data['status']) && $this->data['status'] == CommandGateway::STATUS_OK;
    }

    /**
     * Get the response data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
