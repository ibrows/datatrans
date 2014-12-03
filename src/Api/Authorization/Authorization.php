<?php

namespace Ibrows\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Data\Request\AbstractAuthorizationRequest;
use Ibrows\DataTrans\Constants;
use Ibrows\DataTrans\RequestHandler;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Error\ResponseException;
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
     * @var RequestHandler
     */
    protected $requestHandler;

    /**
     * @param ValidatorInterface   $validator
     * @param ErrorHandler $ErrorHandler
     * @param Serializer   $Serializer
     * @param RequestHandler      $RequestHandler
     */
    public function __construct(
        ValidatorInterface $validator,
        ErrorHandler $ErrorHandler,
        Serializer $Serializer,
        RequestHandler $RequestHandler

    ) {
        $this->validator = $validator;
        $this->errorHandler = $ErrorHandler;
        $this->serializer = $Serializer;
        $this->requestHandler = $RequestHandler;
    }

    /**
     * @param  AbstractAuthorizationRequest           $authorizationRequest
     * @param  History                   $history
     * @return Response
     * @throws ResponseException
     */
    public function authorizationRequest(AbstractAuthorizationRequest $authorizationRequest, History $history = null)
    {
        $violations = $this->validator->validate($authorizationRequest);
        $this->errorHandler->violations($violations);

        $serializedAuthorizationRequest = $this->serializer->serializeToQuery($authorizationRequest);

        $response = $this->requestHandler->request(
            Request::METHOD_POST,
            Constants::URL_AUTHORIZATION,
            $serializedAuthorizationRequest,
            array(),
            $history
        );
    }
}
