<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequest;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\Tests\DataTrans\DataTransProvider;
use Ibrows\Tests\DataTrans\TestDataInterface;
use Pimple\Container;
use Saxulum\HttpClient\History;
use Saxulum\HttpClient\HttpClientInterface;
use Saxulum\HttpClient\Request;

class HiddenAuthorizationTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateAuthorizationRequest()
    {
        $container = new Container();
        $container->register(new DataTransProvider());

        /** @var Authorization $dataTransAuthorization */
        $authorization = $container['datatrans_authorization'];

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $container['datatrans_error_handler'];

        /** @var HttpClientInterface $httpClient */
        $httpClient = $container['datatrans_httpclient'];

        $hiddenAuthorizationRequest = HiddenAuthorizationRequest::getInstance(
            TestDataInterface::TEST_MERCHANTID,
            TestDataInterface::TEST_AMOUNT,
            TestDataInterface::TEST_CURRENCY,
            TestDataInterface::TEST_REFNO,
            TestDataInterface::TEST_URL_SUCCESS,
            TestDataInterface::TEST_URL_FAILED,
            TestDataInterface::TEST_URL_CANCEL
        );

        $hiddenAuthorizationRequest->setPaymentMethod(TestDataInterface::TEST_PAYMENTMETHOD);
        $hiddenAuthorizationRequest->setCardNo(TestDataInterface::TEST_CARDNUMBER);
        $hiddenAuthorizationRequest->setExpm(TestDataInterface::TEST_EXPM);
        $hiddenAuthorizationRequest->setExpy(TestDataInterface::TEST_EXPY);
        $hiddenAuthorizationRequest->setCvv(TestDataInterface::TEST_CVV);

        $hiddenAuthorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
        $hiddenAuthorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
        $hiddenAuthorizationRequest->setUppCustomerFirstName(TestDataInterface::TEST_CUSTOMER_FIRSTNAME);
        $hiddenAuthorizationRequest->setUppCustomerLastName(TestDataInterface::TEST_CUSTOMER_LASTNAME);
        $hiddenAuthorizationRequest->setUppCustomerStreet(TestDataInterface::TEST_CUSTOMER_STREET);
        $hiddenAuthorizationRequest->setUppCustomerCity(TestDataInterface::TEST_CUSTOMER_CITY);
        $hiddenAuthorizationRequest->setUppCustomerZipCode(TestDataInterface::TEST_CUSTOMER_ZIPCODE);
        $hiddenAuthorizationRequest->setUppCustomerCountry(TestDataInterface::TEST_CUSTOMER_COUNTRY);
        $hiddenAuthorizationRequest->setUppCustomerEmail(TestDataInterface::TEST_CUSTOMER_EMAIL);
        $hiddenAuthorizationRequest->setUppCustomerLanguage(TestDataInterface::TEST_CUSTOMER_LANGUAGE);

        $authorizationRequestData = $authorization->buildAuthorizationRequestData($hiddenAuthorizationRequest);

        $violations = $errorHandler->getAndCleanViolations();

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
        $container = new Container();
        $container->register(new DataTransProvider());

        /** @var Authorization $dataTransAuthorization */
        $dataTransAuthorization = $container['datatrans_authorization'];

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $container['datatrans_error_handler'];

        $queryParams = array();
        parse_str(parse_url(TestDataInterface::TEST_RESPONSE_SUCCESS, PHP_URL_QUERY), $queryParams);

        $successAuthorizationResponse = $dataTransAuthorization->parseSuccessAuthorizationResponse($queryParams);

        $violations = $errorHandler->getAndCleanViolations();

        if (count($violations)) {
            var_dump($violations);
        }

        $this->assertCount(0, $violations);

        $this->assertEquals('01', $successAuthorizationResponse->getResponseCode());
        $this->assertEquals('Authorized', $successAuthorizationResponse->getResponseMessage());
        $this->assertEquals(TestDataInterface::TEST_PAYMENTMETHOD, $successAuthorizationResponse->getPMethod());
        $this->assertEquals(null, $successAuthorizationResponse->getReqType());
        $this->assertEquals('110832', $successAuthorizationResponse->getAcqAuthorizationCode());
        $this->assertEquals(null, $successAuthorizationResponse->getAliasCC());
        $this->assertEquals(null, $successAuthorizationResponse->getMaskedCC());
        $this->assertEquals(null, $successAuthorizationResponse->getSign2());
        $this->assertEquals(null, $successAuthorizationResponse->getVirtualCardNo());
        $this->assertEquals('141204110831522029', $successAuthorizationResponse->getUppTransactionId());
        $this->assertEquals(TestDataInterface::TEST_REFNO, $successAuthorizationResponse->getRefNo());
        $this->assertEquals(TestDataInterface::TEST_AMOUNT, $successAuthorizationResponse->getAmount());
        $this->assertEquals(TestDataInterface::TEST_CURRENCY, $successAuthorizationResponse->getCurrency());
        $this->assertEquals('success', $successAuthorizationResponse->getStatus());
        $this->assertEquals(DataInterface::MSGTYPE_GET, $successAuthorizationResponse->getUppMsgType());
    }

    public function testParseFailedAuthorizationReponse()
    {
        $container = new Container();
        $container->register(new DataTransProvider());

        /** @var Authorization $dataTransAuthorization */
        $dataTransAuthorization = $container['datatrans_authorization'];

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $container['datatrans_error_handler'];

        $queryParams = array();
        parse_str(parse_url(TestDataInterface::TEST_RESPONSE_FAILED, PHP_URL_QUERY), $queryParams);

        $failedAuthorizationResponse = $dataTransAuthorization->parseFailedAuthorizationResponse($queryParams);

        $violations = $errorHandler->getAndCleanViolations();

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
        $this->assertEquals(TestDataInterface::TEST_REFNO, $failedAuthorizationResponse->getRefNo());
        $this->assertEquals(TestDataInterface::TEST_AMOUNT, $failedAuthorizationResponse->getAmount());
        $this->assertEquals(TestDataInterface::TEST_CURRENCY, $failedAuthorizationResponse->getCurrency());
        $this->assertEquals('error', $failedAuthorizationResponse->getStatus());
        $this->assertEquals(DataInterface::MSGTYPE_GET, $failedAuthorizationResponse->getUppMsgType());
    }
}
