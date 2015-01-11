<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization\Data\Response;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Response\FailedAuthorizationResponse;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Ibrows\Tests\DataTrans\TestDataInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorInterface;

class FailedAuthorizationResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @param FailedAuthorizationResponse $response
     * @param int        $violationCount
     * @dataProvider failedAuthorizationResponseProvider
     */
    public function testValidationWithAliasCC(FailedAuthorizationResponse $response, $violationCount)
    {
        $validator = $this->getValidator();
        $violations = $validator->validate($response);

        $this->assertEquals($violationCount, $violations->count());
    }

    public function testGetterSetterWithAliasCC()
    {
        $response = new FailedAuthorizationResponse();

        $response->setUppTransactionId('150109131255230325');
        $response->setRefNo(TestDataInterface::REFNO);
        $response->setAmount(TestDataInterface::AMOUNT);
        $response->setCurrency(TestDataInterface::CURRENCY);
        $response->setStatus(DataInterface::RESPONSESTATUS_FAILED);
        $response->setUppMsgType(DataInterface::MSGTYPE_GET);

        $response->setErrorCode('1403');
        $response->setErrorMessage('declined');
        $response->setErrorDetail('Declined');
        $response->setPMethod(TestDataInterface::PAYMENTMETHOD);
        $response->setReqType(DataInterface::REQTYPE_AUTHORIZATIONONLY);
        $response->setAcqErrorCode('50');

        $this->assertEquals('150109131255230325', $response->getUppTransactionId());
        $this->assertEquals(TestDataInterface::REFNO, $response->getRefNo());
        $this->assertEquals(TestDataInterface::AMOUNT, $response->getAmount());
        $this->assertEquals(TestDataInterface::CURRENCY, $response->getCurrency());
        $this->assertEquals(DataInterface::RESPONSESTATUS_FAILED, $response->getStatus());
        $this->assertEquals(DataInterface::MSGTYPE_GET, $response->getUppMsgType());

        $this->assertEquals('1403', $response->getErrorCode());
        $this->assertEquals('declined', $response->getErrorMessage());
        $this->assertEquals('Declined', $response->getErrorDetail());
        $this->assertEquals(TestDataInterface::PAYMENTMETHOD, $response->getPMethod());
        $this->assertEquals(DataInterface::REQTYPE_AUTHORIZATIONONLY, $response->getReqType());
        $this->assertEquals('50', $response->getAcqErrorCode());
        
        $validator = $this->getValidator();
        $violations = $validator->validate($response);

        $this->assertEquals(0, $violations->count());
    }

    /**
     * @return array
     */
    public function failedAuthorizationResponseProvider()
    {
        return array(
            array(
                $this->buildValidReponse(),
                0
            ),
            array(
                new FailedAuthorizationResponse(),
                23
            ),
        );
    }

    protected function buildValidReponse()
    {
        $response = new FailedAuthorizationResponse();
        $response->setErrorCode('1403');
        $response->setErrorMessage('declined');
        $response->setErrorDetail('Declined');
        $response->setPMethod(TestDataInterface::PAYMENTMETHOD);
        $response->setReqType(DataInterface::REQTYPE_AUTHORIZATIONONLY);
        $response->setAcqErrorCode('50');
        $response->setUppTransactionId('150109131255230325');
        $response->setRefNo(TestDataInterface::REFNO);
        $response->setAmount(TestDataInterface::AMOUNT);
        $response->setCurrency(TestDataInterface::CURRENCY);
        $response->setStatus(DataInterface::RESPONSESTATUS_FAILED);
        $response->setUppMsgType(DataInterface::MSGTYPE_GET);

        return $response;
    }

    /**
     * @return Authorization
     */
    protected function getAuthorization()
    {
        if (null === $this->authorization) {
            $errorHandler = new ErrorHandler(new NullLogger());
            $serializer = new Serializer($errorHandler);
            $validator = $this->getValidator();

            $this->authorization =  new Authorization(
                $validator,
                $errorHandler,
                $serializer
            );
        }

        return $this->authorization;
    }

    /**
     * @return ValidatorInterface
     */
    protected function getValidator()
    {
        return Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator()
        ;
    }
}
