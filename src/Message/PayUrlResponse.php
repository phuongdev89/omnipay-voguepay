<?php
/**
 * Created by Navatech.
 * @project cp-bestbuyiptv-com
 * @author  Phuong
 * @email   notteen[at]gmail.com
 * @date    9/17/2019
 * @time    4:24 PM
 */

namespace Omnipay\Voguepay\Message;

use Omnipay\Common\Message\AbstractResponse;

class PayUrlResponse extends AbstractResponse {

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful() {
		return isset($this->data['error']) && $this->data['error'] == 'ok';
	}

	/**
	 * Does the response require a redirect?
	 *
	 * @return boolean
	 */
	public function isRedirect() {
		return false;
	}

	/**
	 * Get the response data.
	 *
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}
}
