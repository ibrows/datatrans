<?php

namespace Ibrows\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Data\Request\AbstractAuthorizationRequest;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequestWithAliasCC;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequestWithCardNo;
use Ibrows\DataTrans\Api\Authorization\Data\Request\StandardAuthorizationRequest;
use Ibrows\DataTrans\Api\Authorization\Data\Response\AbstractAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\CancelAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\FailedAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\SuccessfulAuthorizationResponse;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ValidatorInterface;

class SimpleAuthorization
{
    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @param Authorization $authorization
     */
    public function __construct(Authorization $authorization)
    {
        $this->authorization = $authorization;
    }

    /**
     * @param string $merchantId
     * @param string $amount
     * @param string $currency
     * @param string $refNo
     * @param string $successUrl
     * @param string $errorUrl
     * @param string $cancelUrl
     * @param string|null $sign
     * @return StandardAuthorizationRequest
     */
    public function createStandardAuthorizationRequest(
        $merchantId,
        $amount,
        $currency,
        $refNo,
        $successUrl,
        $errorUrl,
        $cancelUrl,
        $sign = null
    ) {
        return $this->authorization->createStandardAuthorizationRequest(
            $merchantId,
            $amount,
            $currency,
            $refNo,
            $successUrl,
            $errorUrl,
            $cancelUrl,
            $sign
        );
    }

    /**
     * @param string $merchantId
     * @param string $amount
     * @param string $currency
     * @param string $refNo
     * @param string $successUrl
     * @param string $errorUrl
     * @param string $cancelUrl
     * @param string $paymentMethod
     * @param string $cardNo
     * @param string $expm
     * @param string $expy
     * @param string $cvv
     * @param string|null $sign
     * @return HiddenAuthorizationRequestWithCardNo
     */
    public function createHiddenAuthorizationRequestWithCardNo(
        $merchantId,
        $amount,
        $currency,
        $refNo,
        $successUrl,
        $errorUrl,
        $cancelUrl,
        $paymentMethod,
        $cardNo,
        $expm,
        $expy,
        $cvv,
        $sign = null
    ) {
        return $this->authorization->createHiddenAuthorizationRequestWithCardNo(
            $merchantId,
            $amount,
            $currency,
            $refNo,
            $successUrl,
            $errorUrl,
            $cancelUrl,
            $paymentMethod,
            $cardNo,
            $expm,
            $expy,
            $cvv,
            $sign
        );
    }

    /**
     * @param string $merchantId
     * @param string $amount
     * @param string $currency
     * @param string $refNo
     * @param string $successUrl
     * @param string $errorUrl
     * @param string $cancelUrl
     * @param string $aliasCC
     * @param string|null $sign
     * @return HiddenAuthorizationRequestWithAliasCC
     */
    public function createHiddenAuthorizationRequestWithAliasCC(
        $merchantId,
        $amount,
        $currency,
        $refNo,
        $successUrl,
        $errorUrl,
        $cancelUrl,
        $aliasCC,
        $sign = null
    ) {
        return $this->authorization->createHiddenAuthorizationRequestWithAliasCC(
            $merchantId,
            $amount,
            $currency,
            $refNo,
            $successUrl,
            $errorUrl,
            $cancelUrl,
            $aliasCC,
            $sign
        );
    }

    /**
     * @param  AbstractAuthorizationRequest $authorizationRequest
     * @return array
     */
    public function serializeAuthorizationRequest(AbstractAuthorizationRequest $authorizationRequest)
    {
        $this->authorization->validateAuthorizationRequest($authorizationRequest);
        return $this->authorization->serializeAuthorizationRequest($authorizationRequest);
    }

    /**
     * @param string $status
     * @param array  $data
     * @return AbstractAuthorizationResponse
     */
    public function unserializeAuthorizationResponseByStatus($status, array $data)
    {
        $authorizationResponse = $this->authorization->unserializeAuthorizationResponseByStatus($status, $data);
        $this->authorization->validateAuthorizationResponse($authorizationResponse);

        return $authorizationResponse;
    }

    /**
     * @param array $data
     * @return SuccessfulAuthorizationResponse
     */
    public function unserializeSuccessAuthorizationResponse(array $data)
    {
        $authorizationResponse = $this->authorization->unserializeSuccessAuthorizationResponse($data);
        $this->authorization->validateAuthorizationResponse($authorizationResponse);

        return $authorizationResponse;
    }

    /**
     * @param array $data
     * @return FailedAuthorizationResponse
     */
    public function unserializeFailedAuthorizationResponse(array $data)
    {
        $authorizationResponse = $this->authorization->unserializeFailedAuthorizationResponse($data);
        $this->authorization->validateAuthorizationResponse($authorizationResponse);

        return $authorizationResponse;
    }

    /**
     * @param array $data
     * @return CancelAuthorizationResponse
     */
    public function unserializeCancelAuthorizationResponse(array $data)
    {
        $authorizationResponse = $this->authorization->unserializeCancelAuthorizationResponse($data);
        $this->authorization->validateAuthorizationResponse($authorizationResponse);

        return $authorizationResponse;
    }
}
