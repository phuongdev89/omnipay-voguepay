<?php

namespace Omnipay\Voguepay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Voguepay\Message\PayUrlRequest;

/**
 * @method RequestInterface authorize(array $options = [])
 * @method RequestInterface completeAuthorize(array $options = [])
 * @method RequestInterface capture(array $options = [])
 * @method RequestInterface purchase(array $options = [])
 * @method RequestInterface completePurchase(array $options = [])
 * @method RequestInterface refund(array $options = [])
 * @method RequestInterface void(array $options = [])
 * @method RequestInterface createCard(array $options = [])
 * @method RequestInterface updateCard(array $options = [])
 * @method RequestInterface deleteCard(array $options = [])
 */
class Gateway extends AbstractGateway {

	/**
	 * {@inheritDoc}
	 */
	public function getName() {
		return 'Voguepay';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getDefaultParameters() {
		return [
			'v_merchant_id' => '',
			'demo'          => '',
			'notify_url'    => '',
			'success_url'   => '',
		];
	}

	/**
	 * @return mixed
	 */
	public function getDemo() {
		return $this->getParameter('demo');
	}

	/**
	 * @param $value
	 *
	 * @return Gateway
	 */
	public function setDemo($value) {
		return $this->setParameter('demo', $value);
	}

	/**
	 * @return mixed
	 */
	public function getVMerchantId() {
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
	public function setVMerchantId($value) {
		if ($this->getDemo()) {
			return $this->setParameter('v_merchant_id', 'demo');
		} else {
			return $this->setParameter('v_merchant_id', $value);
		}
	}

	/**
	 * @return mixed
	 */
	public function getNotifyUrl() {
		return $this->getParameter('notify_url');
	}

	/**
	 * @param $value
	 *
	 * @return Gateway
	 */
	public function setNotifyUrl($value) {
		return $this->setParameter('notify_url', $value);
	}

	/**
	 * @return mixed
	 */
	public function getSuccessUrl() {
		return $this->getParameter('success_url');
	}

	/**
	 * @param $value
	 *
	 * @return Gateway
	 */
	public function setSuccessUrl($value) {
		return $this->setParameter('success_url', $value);
	}

	/**
	 * @param array $parameters
	 *
	 * @return AbstractRequest|PayUrlRequest
	 */
	public function PayUrl($parameters = []) {
		return $this->createRequest(PayUrlRequest::class, $parameters);
	}
}
