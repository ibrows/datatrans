<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization\Data\Response;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Response\CancelAuthorizationResponse;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Ibrows\Tests\DataTrans\TestDataInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorInterface;

class CancelAuthorizationResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @param CancelAuthorizationResponse $response
     * @param int        $violationCount
     * @dataProvider cancelAuthorizationResponseProvider
     */
    public function testValidationWithAliasCC(CancelAuthorizationResponse $response, $violationCount)
    {
        $validator = $this->getValidator();
        $violations = $validator->validate($response);

        $this->assertEquals($violationCount, $violations->count());
    }

    public function testGetterSetterWithAliasCC()
    {
        $response = new CancelAuthorizationResponse();

        $response->setUppTransactionId('150109131255230325');
        $response->setRefNo(TestDataInterface::REFNO);
        $response->setAmount(TestDataInterface::AMOUNT);
        $response->setCurrency(TestDataInterface::CURRENCY);
        $response->setStatus(DataInterface::RESPONSESTATUS_FAILED);
        $response->setUppMsgType(DataInterface::MSGTYPE_GET);

        $this->assertEquals('150109131255230325', $response->getUppTransactionId());
        $this->assertEquals(TestDataInterface::REFNO, $response->getRefNo());
        $this->assertEquals(TestDataInterface::AMOUNT, $response->getAmount());
        $this->assertEquals(TestDataInterface::CURRENCY, $response->getCurrency());
        $this->assertEquals(DataInterface::RESPONSESTATUS_FAILED, $response->getStatus());
        $this->assertEquals(DataInterface::MSGTYPE_GET, $response->getUppMsgType());
        
        $validator = $this->getValidator();
        $violations = $validator->validate($response);

        $this->assertEquals(0, $violations->count());
    }

    /**
     * @return array
     */
    public function cancelAuthorizationResponseProvider()
    {
        return array(
            array(
                $this->buildValidReponse(),
                0
            ),
            array(
                new CancelAuthorizationResponse(),
                8
            ),
        );
    }

    protected function buildValidReponse()
    {
        $response = new CancelAuthorizationResponse();
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
