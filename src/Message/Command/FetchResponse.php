<?php
/**
 * Created by Navatech.
 * @project cp-bestbuyiptv-com
 * @author  Phuong
 * @email   notteen[at]gmail.com
 * @date    9/18/2019
 * @time    2:44 PM
 */

namespace Omnipay\Voguepay\Message\Command;
class FetchResponse extends AbstractResponse {

	/**
	 * @return mixed
	 */
	public function getValues() {
		if (isset($this->data['values'])) {
			return explode(',', $this->data['values']);
		}
		return false;
	}
}
