<?php

namespace Omnipay\Voguepay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Voguepay\Message\Gateway\PurchaseRequest;
use Omnipay\Voguepay\Message\Gateway\TransactionRequest;

class Gateway extends AbstractGateway
{

    const NAME = 'Voguepay';

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultParameters()
    {
        return [
            'v_merchant_id' => '',
            'demo' => '',
        ];
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
     * @return Gateway
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
     * @return Gateway
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
     * @param array $parameters
     *
     * @return AbstractRequest|PayUrlRequest
     */
    public function purchase($parameters = [])
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|TransactionRequest
     */
    public function transaction($parameters = [])
    {
        return $this->createRequest(TransactionRequest::class, $parameters);
    }
}
