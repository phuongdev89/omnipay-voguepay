<?php
/**
 * Created by Navatech.
 * @project cp-bestbuyiptv-com
 * @author  Phuong
 * @email   notteen[at]gmail.com
 * @date    9/17/2019
 * @time    4:24 PM
 */

namespace Omnipay\Voguepay\Message\Gateway;

use GuzzleHttp\Exception\BadResponseException;
use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest {

	/**
	 * @return mixed
	 */
	public function getFailUrl() {
		return $this->getParameter('fail_url');
	}

	/**
	 * @param $value
	 *
	 * @return PayUrlRequest
	 */
	public function setFailUrl($value) {
		return $this->setParameter('fail_url', $value);
	}

	/**
	 * @return mixed
	 */
	public function getMemo() {
		return $this->getParameter('memo');
	}

	/**
	 * @param $value
	 *
	 * @return PayUrlRequest
	 */
	public function setMemo($value) {
		return $this->setParameter('memo', $value);
	}

	/**
	 * @return mixed
	 */
	public function getDeveloperCode() {
		return $this->getParameter('developer_code');
	}

	/**
	 * @param $value
	 *
	 * @return PayUrlRequest
	 */
	public function setDeveloperCode($value) {
		return $this->setParameter('developer_code', $value);
	}

	/**
	 * @return mixed
	 */
	public function getTotal() {
		return $this->getParameter('total');
	}

	/**
	 * @param $value
	 *
	 * @return PayUrlRequest
	 */
	public function setTotal($value) {
		return $this->setParameter('total', $value);
	}

	/**
	 * @return mixed
	 */
	public function getMerchantRef() {
		return $this->getParameter('merchant_ref');
	}

	/**
	 * @param $value
	 *
	 * @return PayUrlRequest
	 */
	public function setMerchantRef($value) {
		return $this->setParameter('merchant_ref', $value);
	}

	/**
	 * @return mixed
	 */
	public function getCur() {
		return $this->getParameter('cur');
	}

	/**
	 * @param $value
	 *
	 * @return PayUrlRequest
	 */
	public function setCur($value) {
		return $this->setParameter('cur', $value);
	}

	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 * @throws InvalidRequestException
	 */
	public function getData() {
		$this->validate([
			'memo',
			'v_merchant_id',
			'total',
			'merchant_ref',
			'cur',
		]);
		return [
			'p'              => 'linkToken',
			'v_merchant_id'  => $this->getVMerchantId(),
			'memo'           => $this->getMemo(),
			'total'          => $this->getTotal(),
			'notify_url'     => $this->getNotifyUrl(),
			'success_url'    => $this->getSuccessUrl(),
			'fail_url'       => $this->getFailUrl(),
			'merchant_ref'   => $this->getMerchantRef(),
			'cur'            => $this->getCur(),
			'developer_code' => $this->getDeveloperCode(),
		];
	}

	/**
	 * Send the request with specified data
	 *
	 * @param mixed $data The data to send
	 *
	 * @return PayUrlResponse
	 */
	public function sendData($data) {
		try {
			$response = $this->httpClient->request('GET', $this->getEndpoint() . http_build_query($data));
		} catch (BadResponseException $e) {
			$response = $e->getResponse();
		}
		$result = ['pay_url' => $response->getBody()->getContents()];
		return new PayUrlResponse($this, $result);
	}
}
