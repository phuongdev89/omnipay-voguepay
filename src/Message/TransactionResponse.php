<?php

namespace Omnipay\Voguepay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Response
 */
class TransactionResponse extends AbstractResponse {

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful() {
		return is_array($this->data) && $this->data != null;
	}

	public function getMerchantId() {
		if (isset($this->data['merchant_id'])) {
			return $this->data['merchant_id'];
		}
		return false;
	}

	public function getTransactionId() {
		if (isset($this->data['transaction_id'])) {
			return $this->data['transaction_id'];
		}
		return false;
	}

	public function getEmail() {
		if (isset($this->data['email'])) {
			return $this->data['email'];
		}
		return false;
	}

	public function getTotal() {
		if (isset($this->data['total'])) {
			return $this->data['total'];
		}
		return false;
	}

	public function getTotalPaidByBuyer() {
		if (isset($this->data['total_paid_by_buyer'])) {
			return $this->data['total_paid_by_buyer'];
		}
		return false;
	}

	public function getTotalCreditedToMerchant() {
		if (isset($this->data['total_credited_to_merchant'])) {
			return $this->data['total_credited_to_merchant'];
		}
		return false;
	}

	public function getExtraChargesByMerchant() {
		if (isset($this->data['extra_charges_by_merchant'])) {
			return $this->data['extra_charges_by_merchant'];
		}
		return false;
	}

	public function getMerchantRef() {
		if (isset($this->data['merchant_ref'])) {
			return $this->data['merchant_ref'];
		}
		return false;
	}

	public function getMemo() {
		if (isset($this->data['memo'])) {
			return $this->data['memo'];
		}
		return false;
	}

	public function getStatus() {
		if (isset($this->data['status'])) {
			return $this->data['status'];
		}
		return false;
	}

	public function getDate() {
		if (isset($this->data['date'])) {
			return $this->data['date'];
		}
		return false;
	}

	public function getReferrer() {
		if (isset($this->data['referrer'])) {
			return $this->data['referrer'];
		}
		return false;
	}

	public function getFundMaturity() {
		if (isset($this->data['fund_maturity'])) {
			return $this->data['fund_maturity'];
		}
		return false;
	}

	public function getCur() {
		if (isset($this->data['cur'])) {
			return $this->data['cur'];
		}
		return false;
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
