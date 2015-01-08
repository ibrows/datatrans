<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization;

use Buzz\Browser;
use Buzz\Client\Curl;
use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequestWithCardNo;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Ibrows\Tests\DataTrans\TestDataInterface;
use Psr\Log\NullLogger;
use Saxulum\HttpClient\Buzz\HttpClient;
use Saxulum\HttpClient\History;
use Saxulum\HttpClient\HttpClientInterface;
use Saxulum\HttpClient\Request;
use Symfony\Component\Validator\Validation;

class HiddenAuthorizationWithCardNoTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateAuthorizationRequest()
    {
        $authorization = $this->getAuthorization();
        $httpClient = $this->getHttpClient();

        $hiddenAuthorizationRequest = HiddenAuthorizationRequestWithCardNo::createValidInstance(
            TestDataInterface::MERCHANTID,
            TestDataInterface::AMOUNT,
            TestDataInterface::CURRENCY,
            TestDataInterface::REFNO,
            TestDataInterface::URL_SUCCESS,
            TestDataInterface::URL_FAILED,
            TestDataInterface::URL_CANCEL,
            TestDataInterface::PAYMENTMETHOD,
            TestDataInterface::CARDNUMBER,
            TestDataInterface::EXPM,
            TestDataInterface::EXPY,
            TestDataInterface::CVV
        );

        $hiddenAuthorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
        $hiddenAuthorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
        $hiddenAuthorizationRequest->setUppCustomerFirstName(TestDataInterface::CUSTOMER_FIRSTNAME);
        $hiddenAuthorizationRequest->setUppCustomerLastName(TestDataInterface::CUSTOMER_LASTNAME);
        $hiddenAuthorizationRequest->setUppCustomerStreet(TestDataInterface::CUSTOMER_STREET);
        $hiddenAuthorizationRequest->setUppCustomerCity(TestDataInterface::CUSTOMER_CITY);
        $hiddenAuthorizationRequest->setUppCustomerZipCode(TestDataInterface::CUSTOMER_ZIPCODE);
        $hiddenAuthorizationRequest->setUppCustomerCountry(TestDataInterface::CUSTOMER_COUNTRY);
        $hiddenAuthorizationRequest->setUppCustomerEmail(TestDataInterface::CUSTOMER_EMAIL);
        $hiddenAuthorizationRequest->setUppCustomerLanguage(TestDataInterface::CUSTOMER_LANGUAGE);

        $authorizationRequestData = $authorization->buildAuthorizationRequestData($hiddenAuthorizationRequest);
        $this->assertArrayHasKey('uppCustomerLanguage', $authorizationRequestData);
        $this->assertEquals(TestDataInterface::CUSTOMER_LANGUAGE, $authorizationRequestData['uppCustomerLanguage']);

        $violations = $authorization->getAndCleanViolations();

        if (count($violations)) {
            var_dump($violations);
        }

        $this->assertCount(0, $violations);

        $response = $httpClient->request(new Request(
            '1.1',
            Request::METHOD_POST,
            DataInterface::URL_AUTHORIZATION,
            array(),
            http_build_query($authorizationRequestData)
        ));

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testParseSuccessAuthorizationReponse()
    {
        $authorization = $this->getAuthorization();

        $queryParams = array();
        parse_str(parse_url(TestDataInterface::RESPONSE_SUCCESS, PHP_URL_QUERY), $queryParams);

        $successAuthorizationResponse = $authorization->parseSuccessAuthorizationResponse($queryParams);

        $violations = $authorization->getAndCleanViolations();

        if (count($violations)) {
            var_dump($violations);
        }

        $this->assertCount(0, $violations);

        $this->assertEquals('01', $successAuthorizationResponse->getResponseCode());
        $this->assertEquals('Authorized', $successAuthorizationResponse->getResponseMessage());
        $this->assertEquals(TestDataInterface::PAYMENTMETHOD, $successAuthorizationResponse->getPMethod());
        $this->assertEquals(null, $successAuthorizationResponse->getReqType());
        $this->assertEquals('110832', $successAuthorizationResponse->getAcqAuthorizationCode());
        $this->assertEquals(null, $successAuthorizationResponse->getAliasCC());
        $this->assertEquals(null, $successAuthorizationResponse->getMaskedCC());
        $this->assertEquals(null, $successAuthorizationResponse->getSign2());
        $this->assertEquals(null, $successAuthorizationResponse->getVirtualCardNo());
        $this->assertEquals('141204110831522029', $successAuthorizationResponse->getUppTransactionId());
        $this->assertEquals(TestDataInterface::REFNO, $successAuthorizationResponse->getRefNo());
        $this->assertEquals(TestDataInterface::AMOUNT, $successAuthorizationResponse->getAmount());
        $this->assertEquals(TestDataInterface::CURRENCY, $successAuthorizationResponse->getCurrency());
        $this->assertEquals('success', $successAuthorizationResponse->getStatus());
        $this->assertEquals(DataInterface::MSGTYPE_GET, $successAuthorizationResponse->getUppMsgType());
    }

    public function testParseFailedAuthorizationReponse()
    {
        $authorization = $this->getAuthorization();

        $queryParams = array();
        parse_str(parse_url(TestDataInterface::RESPONSE_FAILED, PHP_URL_QUERY), $queryParams);

        $failedAuthorizationResponse = $authorization->parseFailedAuthorizationResponse($queryParams);

        $violations = $authorization->getAndCleanViolations();

        if (count($violations)) {
            var_dump($violations);
        }

        $this->assertCount(0, $violations);

        $this->assertEquals('1003', $failedAuthorizationResponse->getErrorCode());
        $this->assertEquals('null', $failedAuthorizationResponse->getErrorMessage());
        $this->assertEquals('merchantId', $failedAuthorizationResponse->getErrorDetail());
        $this->assertEquals(null, $failedAuthorizationResponse->getPMethod());
        $this->assertEquals(null, $failedAuthorizationResponse->getReqType());
        $this->assertEquals(null, $failedAuthorizationResponse->getAcqErrorCode());
        $this->assertEquals('141204131558314439', $failedAuthorizationResponse->getUppTransactionId());
        $this->assertEquals(TestDataInterface::REFNO, $failedAuthorizationResponse->getRefNo());
        $this->assertEquals(TestDataInterface::AMOUNT, $failedAuthorizationResponse->getAmount());
        $this->assertEquals(TestDataInterface::CURRENCY, $failedAuthorizationResponse->getCurrency());
        $this->assertEquals('error', $failedAuthorizationResponse->getStatus());
        $this->assertEquals(DataInterface::MSGTYPE_GET, $failedAuthorizationResponse->getUppMsgType());
    }

    /**
     * @return Authorization
     */
    protected function getAuthorization()
    {
        $errorHandler = new ErrorHandler(new NullLogger());
        $serializer = new Serializer($errorHandler);
        $validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator()
        ;

        return new Authorization(
            $validator,
            $errorHandler,
            $serializer
        );
    }

    /**
     * @return HttpClient
     */
    protected function getHttpClient()
    {
        return new HttpClient(new Browser(new Curl()));
    }
}
