<?php
/**
 * Created by phuongdev89.
 * @author  Phuong
 * @email   phuongdev89@gmail.com
 * @date    9/18/2019
 * @time    2:44 PM
 */

namespace Omnipay\Voguepay\Message\Command;
class FetchResponse extends AbstractResponse
{

    /**
     * @return false|string[]
     */
    public function getValues()
    {
        if (isset($this->data['values'])) {
            return explode(',', $this->data['values']);
        }
        return false;
    }
}
