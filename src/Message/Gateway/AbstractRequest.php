<?php

namespace Omnipay\Voguepay\Message\Gateway;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * @method ResponseInterface send(array $options = [])
 */
abstract class AbstractRequest extends BaseAbstractRequest
{

    protected $endpoint = "https://voguepay.com/";

    /**
     * {@inheritDoc}
     */
    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }

    /**
     * {@inheritDoc}
     */
    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
    }

    /**
     * @return mixed
     */
    public function getSuccessUrl()
    {
        return $this->getParameter('success_url');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setSuccessUrl($value)
    {
        return $this->setParameter('success_url', $value);
    }

    /**
     * @return mixed
     */
    public function getDemo()
    {
        return $this->getParameter('demo');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setDemo($value)
    {
        return $this->setParameter('demo', $value);
    }

    /**
     * @return mixed
     */
    public function getVMerchantId()
    {
        if ($this->getDemo()) {
            return 'demo';
        } else {
            return $this->getParameter('v_merchant_id');
        }
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setVMerchantId($value)
    {
        if ($this->getDemo()) {
            return $this->setParameter('v_merchant_id', 'demo');
        } else {
            return $this->setParameter('v_merchant_id', $value);
        }
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint . '?';
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
