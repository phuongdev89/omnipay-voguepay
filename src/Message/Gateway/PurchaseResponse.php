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

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse {

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful() {
		return isset($this->data['pay_url']) && $this->data['pay_url'] != '';
	}

	/**
	 * Does the response require a redirect?
	 *
	 * @return boolean
	 */
	public function isRedirect() {
		return true;
	}

	/**
	 * Get the response data.
	 *
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	public function getPayUrl() {
		return $this->data['pay_url'];
	}
}
