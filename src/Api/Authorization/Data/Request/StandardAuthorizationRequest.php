<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Request;

class StandardAuthorizationRequest extends AbstractAuthorizationRequest
{
    /**
     * @param string $merchantId
     * @param string $amount
     * @param string $currency
     * @param string $refNo
     * @param string $sign
     * @param string $successUrl
     * @param string $errorUrl
     * @param string $cancelUrl
     * @return StandardAuthorizationRequest
     */
    public static function getInstance(
        $merchantId,
        $amount,
        $currency,
        $refNo,
        $sign,
        $successUrl,
        $errorUrl,
        $cancelUrl
    ) {
        $instance = new self();

        $instance->setMerchantId($merchantId);
        $instance->setAmount($amount);
        $instance->setCurrency($currency);
        $instance->setRefNo($refNo);
        $instance->setSign($sign);
        $instance->setSuccessUrl($successUrl);
        $instance->setErrorUrl($errorUrl);
        $instance->setCancelUrl($cancelUrl);

        return $instance;
    }
}
