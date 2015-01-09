<?php

namespace Ibrows\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Data\Request\AbstractAuthorizationRequest;
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
     * @param  AbstractAuthorizationRequest $authorizationRequest
     * @return array
     */
    public function serializeAuthorizationRequestData(AbstractAuthorizationRequest $authorizationRequest)
    {
        $this->authorization->validateAuthorizationRequest($authorizationRequest);
        return $this->authorization->serializeAuthorizationRequestData($authorizationRequest);
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
