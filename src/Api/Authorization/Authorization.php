<?php

namespace Ibrows\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Data\Request\AbstractAuthorizationRequest;
use Ibrows\DataTrans\Api\Authorization\Data\Response\AbstractAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\CancelAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\FailedAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\SuccessfulAuthorizationResponse;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ValidatorInterface;

class Authorization
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var ErrorHandler
     */
    protected $errorHandler;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @param ValidatorInterface   $validator
     * @param ErrorHandler $ErrorHandler
     * @param Serializer   $Serializer
     */
    public function __construct(
        ValidatorInterface $validator,
        ErrorHandler $ErrorHandler,
        Serializer $Serializer
    ) {
        $this->validator = $validator;
        $this->errorHandler = $ErrorHandler;
        $this->serializer = $Serializer;
    }

    /**
     * @param AbstractAuthorizationRequest $authorizationRequest
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    public function validateAuthorizationRequest(AbstractAuthorizationRequest $authorizationRequest)
    {
        $violations = $this->validator->validate($authorizationRequest);
        $this->errorHandler->violations($violations);

        return $violations;
    }

    /**
     * @param  AbstractAuthorizationRequest $authorizationRequest
     * @return array
     */
    public function serializeAuthorizationRequest(AbstractAuthorizationRequest $authorizationRequest)
    {
        return $this->serializer->serializeToArray($authorizationRequest);
    }

    /**
     * @param string $status
     * @param array  $data
     * @return AbstractAuthorizationResponse
     */
    public function unserializeAuthorizationResponseByStatus($status, array $data)
    {
        if (DataInterface::RESPONSESTATUS_SUCCESS === $status) {
            return $this->unserializeSuccessAuthorizationResponse($data);
        } elseif (DataInterface::RESPONSESTATUS_FAILED === $status) {
            return $this->unserializeFailedAuthorizationResponse($data);
        } elseif (DataInterface::RESPONSESTATUS_CANCEL === $status) {
            return $this->unserializeCancelAuthorizationResponse($data);
        }

        throw new \InvalidArgumentException("Unknown reponse status: {$status}");
    }

    /**
     * @param array $data
     * @return SuccessfulAuthorizationResponse
     */
    public function unserializeSuccessAuthorizationResponse(array $data)
    {
        $authorizationResponse = new SuccessfulAuthorizationResponse();
        $this->serializer->unserializeFromArray($authorizationResponse, $data);

        return $authorizationResponse;
    }

    /**
     * @param array $data
     * @return FailedAuthorizationResponse
     */
    public function unserializeFailedAuthorizationResponse(array $data)
    {
        $authorizationResponse = new FailedAuthorizationResponse();
        $this->serializer->unserializeFromArray($authorizationResponse, $data);

        return $authorizationResponse;
    }

    /**
     * @param array $data
     * @return CancelAuthorizationResponse
     */
    public function unserializeCancelAuthorizationResponse(array $data)
    {
        $authorizationResponse = new CancelAuthorizationResponse();
        $this->serializer->unserializeFromArray($authorizationResponse, $data);

        return $authorizationResponse;
    }

    /**
     * @param AbstractAuthorizationResponse $authorizationResponse
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    public function validateAuthorizationResponse(AbstractAuthorizationResponse $authorizationResponse)
    {
        $violations = $this->validator->validate($authorizationResponse);
        $this->errorHandler->violations($violations);

        return $violations;
    }
}
