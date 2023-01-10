<?php
/**
 * Created by phuongdev89.
 * @author  Phuong
 * @email   phuongdev89@gmail.com
 * @date    9/18/2019
 * @time    9:58 AM
 */

namespace Omnipay\Voguepay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Voguepay\Message\Command\AbstractRequest;
use Omnipay\Voguepay\Message\Command\CreateRequest;
use Omnipay\Voguepay\Message\Command\FetchRequest;
use Omnipay\Voguepay\Message\Command\PayRequest;
use Omnipay\Voguepay\Message\Command\WithdrawRequest;

/**
 * @method RequestInterface authorize(array $options = array())
 * @method RequestInterface completeAuthorize(array $options = array())
 * @method RequestInterface capture(array $options = array())
 * @method RequestInterface purchase(array $options = array())
 * @method RequestInterface completePurchase(array $options = array())
 * @method RequestInterface refund(array $options = array())
 * @method RequestInterface void(array $options = array())
 * @method RequestInterface createCard(array $options = array())
 * @method RequestInterface updateCard(array $options = array())
 * @method RequestInterface deleteCard(array $options = array())
 * @method FetchRequest fetch(array $options = array())
 * @method WithdrawRequest withdraw(array $options = array())
 * @method PayRequest pay(array $options = array())
 * @method CreateRequest create(array $options = array())
 */
class CommandGateway extends AbstractGateway
{

    const NAME = 'Voguepay_Command';

    const API_FETCH = 'fetch';

    const API_WITHDRAW = 'withdraw';

    const API_PAY = 'pay';

    const API_CREATE = 'create';

    const STATUS_OK = 'OK';

    const STATUS_FAIL = 'FAIL';

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
            'merchant' => '',
            'email' => '',
            'command_api_token' => '',
        ];
    }

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
     * @return self
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
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
     * @return self
     */
    public function setMerchant($value)
    {
        return $this->setParameter('merchant', $value);
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
     * @return self
     */
    public function setCommandApiToken($value)
    {
        return $this->setParameter('command_api_token', $value);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return \Omnipay\Common\Message\AbstractRequest|AbstractRequest
     */
    public function __call($name, $arguments)
    {
        return $this->command($name, $arguments[0]);
    }

    /**
     * @param string $task
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|AbstractRequest
     */
    public function command($task, $parameters = [])
    {
        switch ($task) {
            case CommandGateway::API_FETCH:
                return $this->createRequest(FetchRequest::class, $parameters);
            case CommandGateway::API_CREATE:
                return $this->createRequest(CreateRequest::class, $parameters);
            case CommandGateway::API_WITHDRAW:
                return $this->createRequest(WithdrawRequest::class, $parameters);
            case CommandGateway::API_PAY:
            default:
                return $this->createRequest(PayRequest::class, $parameters);
        }
    }

    /**
     * @param $key
     *
     * @return mixed|string
     */
    public static function response($key)
    {
        $responses = [
            'OK' => 'successful operation',
            'X001' => 'Invalid Merchant ID',
            'X002' => 'Invalid Reference',
            'X003' => 'Invalid hash',
            'X004' => 'Invalid task',
            'X005' => 'Invalid Merchant ID',
            'X006' => 'Invalid hash',
            'C001' => 'Unauthorised access',
            'C002' => 'Invalid Email',
            'C003' => 'Invalid username',
            'C004' => 'Invalid phone number',
            'C005' => 'Invalid firstname',
            'C006' => 'Invalid lastname',
            'C007' => 'Invalid country',
            'C008' => 'Unable to create member',
            'C009' => 'Currency not supported by country provided',
            'C010' => 'Password must contain at Least one numeric value (0-9), one Uppercase, one Lowercase and one special character',
            'C011' => 'Invalid Currency',
            'W001' => 'Invalid amount',
            'W002' => 'Operation Failed.',
            'W003' => 'Amount is below minimum allowed',
            'W004' => 'Insufficient balance',
            'W005' => 'Withdrawal failed',
            'W006' => 'Withdrawal failed',
            'P001' => 'Invalid amount',
            'P002' => 'Operation Failed.',
            'P003' => 'Seller and buyer are one and the same',
            'P004' => 'Invalid beneficiary',
            'P005' => 'Invalid memo',
            'P006' => 'payment amount is below minimum allowed',
            'P007' => 'payment amount exceeds maximum allowed',
            'P008' => 'Insufficient balance for payment',
            'P009' => 'Payment failed',
            'P010' => 'Payment failed',
            'P011' => 'Payment failed',
            'WL000' => 'System error',
            'WL001' => 'Invalid Parameters',
            'WL002' => 'Validation Error',
            'WL003' => 'Transaction Request Declined',
            'WL004' => 'Currency is not allowed',
            'WL3D' => '3D Authorization required',
        ];
        if (isset($responses[$key])) {
            return $responses[$key];
        }
        return 'Unknown response';
    }
}
