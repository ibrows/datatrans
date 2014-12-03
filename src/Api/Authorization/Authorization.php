<?php

namespace Ibrows\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Data\AuthorizationRequest;
use Ibrows\DataTrans\Constants;
use Ibrows\DataTrans\DataTransRequest;
use Ibrows\DataTrans\Error\DataTransErrorHandler;
use Ibrows\DataTrans\Error\DataTransResponseException;
use Ibrows\DataTrans\Error\DataTransResultException;
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
     * @param  AuthorizationRequest           $authorizationRequest
     * @param  History                   $history
     * @return Response
     * @throws DataTransResponseException
     * @throws DataTransResultException
     */
    public function authorization(AuthorizationRequest $authorizationRequest, History $history = null)
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

        // event, if something went wrong within the authorization, we get an ok, as logn the request is well formed
        if ('OK:' !== substr($response->getContent(), 0, 3)) {
            $this->dataTransErrorHandler->response($response);
        }

        $authorizationResponse = new Response();

        $this->dataTransSerializer->unserializeXml($authorizationResponse, substr($response->getContent(), 3));

        // something went wrong within the authorization
        if ('0' !== $authorizationResponse->getResult()) {
            $this->dataTransErrorHandler->result('0', $authorizationResponse->getResult());
        }

        return $authorizationResponse;
    }

    /**
     * @param  PayCompleteRequest  $payCompleteRequest
     * @param  History             $history
     * @return PayCompleteResponse
     * @throws \Exception
     */
    public function payComplete(PayCompleteRequest $payCompleteRequest, History $history = null)
    {
        $violations = $this->validator->validate($payCompleteRequest);
        $this->dataTransErrorHandler->violations($violations);;

        $serializedPayCompleteRequest = $this->dataTransSerializer->serialize($payCompleteRequest);

        $response = $this->dataTransRequest->request(
            Request::METHOD_GET,
            Constants::PAY_COMPLETE_V2 . '?' . $serializedPayCompleteRequest,
            null,
            array(),
            $history
        );

        // event, if something went wrong within the pay complete, we get an ok, as logn the request is well formed
        if ('OK:' !== substr($response->getContent(), 0, 3)) {
            $this->dataTransErrorHandler->response($response);
        }

        $payCompleteResponse = new PayCompleteResponse();

        $this->dataTransSerializer->unserializeXml($payCompleteResponse, substr($response->getContent(), 3));

        // something went wrong within the pay complete
        if ('0' !== $payCompleteResponse->getResult()) {
            $this->dataTransErrorHandler->result('0', $payCompleteResponse->getResult());
        }

        return $payCompleteResponse;
    }
}
