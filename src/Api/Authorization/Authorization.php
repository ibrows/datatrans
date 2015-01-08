<?php

namespace Ibrows\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Data\Request\AbstractAuthorizationRequest;
use Ibrows\DataTrans\Api\Authorization\Data\Response\AbstractAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\CancelAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\FailedAuthorizationResponse;
use Ibrows\DataTrans\Api\Authorization\Data\Response\SuccessfulAuthorizationResponse;
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
     * @param  AbstractAuthorizationRequest           $authorizationRequest
     * @return array
     */
    public function buildAuthorizationRequestData(AbstractAuthorizationRequest $authorizationRequest)
    {
        $violations = $this->validator->validate($authorizationRequest);
        $this->errorHandler->violations($violations);

        return $this->serializer->serializeToArray($authorizationRequest);
    }

    /**
     * @param array $data
     * @return SuccessfulAuthorizationResponse
     */
    public function parseSuccessAuthorizationResponse(array $data)
    {
        return $this->parseAuthorizationResponse(new SuccessfulAuthorizationResponse(), $data);
    }

    /**
     * @param array $data
     * @return FailedAuthorizationResponse
     */
    public function parseFailedAuthorizationResponse(array $data)
    {
        return $this->parseAuthorizationResponse(new FailedAuthorizationResponse(), $data);
    }

    /**
     * @param array $data
     * @return CancelAuthorizationResponse
     */
    public function parseCancelAuthorizationResponse(array $data)
    {
        return $this->parseAuthorizationResponse(new CancelAuthorizationResponse(), $data);
    }

    /**
     * @param AbstractAuthorizationResponse $authorizationResponse
     * @param array                         $data
     * @return AbstractAuthorizationResponse
     */
    protected function parseAuthorizationResponse(AbstractAuthorizationResponse $authorizationResponse, array $data)
    {
        $this->serializer->unserializeFromArray($authorizationResponse, $data);

        return $authorizationResponse;
    }

    /**
     * @return ConstraintViolationInterface
     */
    public function getAndCleanViolations()
    {
        return $this->errorHandler->getAndCleanViolations();
    }
}
