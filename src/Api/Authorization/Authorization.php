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
use Saxulum\HttpClient\History;
use Saxulum\HttpClient\Request;
use Saxulum\HttpClient\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @return Request
     */
    public function buildAuthorizationRequest(AbstractAuthorizationRequest $authorizationRequest)
    {
        $violations = $this->validator->validate($authorizationRequest);
        $this->errorHandler->violations($violations);

        $serializedAuthorizationRequest = $this->serializer->serializeToQuery($authorizationRequest);

        return new Request(
            '1.1',
            Request::METHOD_GET,
            DataInterface::URL_AUTHORIZATION . '?' . $serializedAuthorizationRequest
        );
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
        $this->serializer->unserializeArray($authorizationResponse, $data);

        return $authorizationResponse;
    }
}
