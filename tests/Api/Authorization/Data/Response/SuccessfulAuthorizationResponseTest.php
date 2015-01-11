<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization\Data\Response;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Response\SuccessfulAuthorizationResponse;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Ibrows\Tests\DataTrans\TestDataInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorInterface;

class SuccessfulAuthorizationResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @param SuccessfulAuthorizationResponse $response
     * @param int        $violationCount
     * @dataProvider successfulAuthorizationResponseProvider
     */
    public function testValidationWithAliasCC(SuccessfulAuthorizationResponse $response, $violationCount)
    {
        $validator = $this->getValidator();
        $violations = $validator->validate($response);

        $this->assertEquals($violationCount, $violations->count());
    }

    public function testGetterSetterWithAliasCC()
    {
        $response = new SuccessfulAuthorizationResponse();

        $response->setUppTransactionId('150109131255230325');
        $response->setRefNo(TestDataInterface::REFNO);
        $response->setAmount(TestDataInterface::AMOUNT);
        $response->setCurrency(TestDataInterface::CURRENCY);
        $response->setStatus(DataInterface::RESPONSESTATUS_SUCCESS);
        $response->setUppMsgType(DataInterface::MSGTYPE_GET);

        $response->setResponseCode('01');
        $response->setResponseMessage('Authorized');
        $response->setPMethod(TestDataInterface::PAYMENTMETHOD);
        $response->setReqType(DataInterface::REQTYPE_AUTHORIZATIONONLY);
        $response->setAcqAuthorizationCode('131256');
        $response->setAliasCC(TestDataInterface::ALIASCC);
        $response->setMaskedCC('masked');
        $response->setSign2(TestDataInterface::SIGN);
        $response->setVirtualCardNo(TestDataInterface::CARDNUMBER);

        $this->assertEquals('150109131255230325', $response->getUppTransactionId());
        $this->assertEquals(TestDataInterface::REFNO, $response->getRefNo());
        $this->assertEquals(TestDataInterface::AMOUNT, $response->getAmount());
        $this->assertEquals(TestDataInterface::CURRENCY, $response->getCurrency());
        $this->assertEquals(DataInterface::RESPONSESTATUS_SUCCESS, $response->getStatus());
        $this->assertEquals(DataInterface::MSGTYPE_GET, $response->getUppMsgType());

        $this->assertEquals('01', $response->getResponseCode());
        $this->assertEquals('Authorized', $response->getResponseMessage());
        $this->assertEquals(TestDataInterface::PAYMENTMETHOD, $response->getPMethod());
        $this->assertEquals(DataInterface::REQTYPE_AUTHORIZATIONONLY, $response->getReqType());
        $this->assertEquals('131256', $response->getAcqAuthorizationCode());
        $this->assertEquals(TestDataInterface::ALIASCC, $response->getAliasCC());
        $this->assertEquals('masked', $response->getMaskedCC());
        $this->assertEquals(TestDataInterface::SIGN, $response->getSign2());
        $this->assertEquals(TestDataInterface::CARDNUMBER, $response->getVirtualCardNo());

        $validator = $this->getValidator();
        $violations = $validator->validate($response);

        $this->assertEquals(0, $violations->count());
    }

    /**
     * @return array
     */
    public function successfulAuthorizationResponseProvider()
    {
        return array(
            array(
                $this->buildValidReponse(),
                0
            ),
            array(
                new SuccessfulAuthorizationResponse(),
                22
            ),
        );
    }

    protected function buildValidReponse()
    {
        $response = new SuccessfulAuthorizationResponse();
        $response->setResponseCode('01');
        $response->setResponseMessage('Authorized');
        $response->setPMethod(TestDataInterface::PAYMENTMETHOD);
        $response->setReqType(DataInterface::REQTYPE_AUTHORIZATIONONLY);
        $response->setAcqAuthorizationCode('131256');
        $response->setUppTransactionId('150109131255230325');
        $response->setRefNo(TestDataInterface::REFNO);
        $response->setAmount(TestDataInterface::AMOUNT);
        $response->setCurrency(TestDataInterface::CURRENCY);
        $response->setStatus(DataInterface::RESPONSESTATUS_SUCCESS);
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
