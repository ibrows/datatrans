<?php

namespace Ibrows\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Data\Request\AbstractAuthorizationRequest;
use Ibrows\DataTrans\Constants;
use Ibrows\DataTrans\DataTransRequest;
use Ibrows\DataTrans\Error\DataTransErrorHandler;
use Ibrows\DataTrans\Error\DataTransResponseException;
use Ibrows\DataTrans\Serializer\DataTransSerializer;
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
     * @var DataTransErrorHandler
     */
    protected $dataTransErrorHandler;

    /**
     * @var DataTransSerializer
     */
    protected $dataTransSerializer;

    /**
     * @var DataTransRequest
     */
    protected $dataTransRequest;

    /**
     * @param ValidatorInterface   $validator
     * @param DataTransErrorHandler $DataTransErrorHandler
     * @param DataTransSerializer   $DataTransSerializer
     * @param DataTransRequest      $DataTransRequest
     */
    public function __construct(
        ValidatorInterface $validator,
        DataTransErrorHandler $DataTransErrorHandler,
        DataTransSerializer $DataTransSerializer,
        DataTransRequest $DataTransRequest

    ) {
        $this->validator = $validator;
        $this->dataTransErrorHandler = $DataTransErrorHandler;
        $this->dataTransSerializer = $DataTransSerializer;
        $this->dataTransRequest = $DataTransRequest;
    }

    /**
     * @param  AbstractAuthorizationRequest           $authorizationRequest
     * @param  History                   $history
     * @return Response
     * @throws DataTransResponseException
     */
    public function authorizationRequest(AbstractAuthorizationRequest $authorizationRequest, History $history = null)
    {
        $violations = $this->validator->validate($authorizationRequest);
        $this->dataTransErrorHandler->violations($violations);

        $serializedAuthorizationRequest = $this->dataTransSerializer->serializeToQuery($authorizationRequest);

        $response = $this->dataTransRequest->request(
            Request::METHOD_GET,
            Constants::URL_AUTHORIZATION . '?' . $serializedAuthorizationRequest,
            null,
            array(),
            $history
        );

        var_dump($response);
    }
}
