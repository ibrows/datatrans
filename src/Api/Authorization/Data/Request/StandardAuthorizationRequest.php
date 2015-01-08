<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Request;

class StandardAuthorizationRequest extends AbstractAuthorizationRequest
{
    /**
     * @param string $merchantId
     * @param string $amount
     * @param string $currency
     * @param string $refNo
     * @param string $successUrl
     * @param string $errorUrl
     * @param string $cancelUrl
     * @param string $sign
     * @return static
     */
    public static function createValidInstance(
        $merchantId,
        $amount,
        $currency,
        $refNo,
        $successUrl,
        $errorUrl,
        $cancelUrl,
        $sign = null
    ) {
        $instance = new static();

        $instance->setMerchantId($merchantId);
        $instance->setAmount($amount);
        $instance->setCurrency($currency);
        $instance->setRefNo($refNo);
        $instance->setSuccessUrl($successUrl);
        $instance->setErrorUrl($errorUrl);
        $instance->setCancelUrl($cancelUrl);
        $instance->setSign($sign);

        return $instance;
    }
}
