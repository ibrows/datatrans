<?php

namespace Ibrows\Tests\SaferpayBusiness\Api\SecureCardData\Add\Data;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Request\StandardAuthorizationRequest;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Ibrows\Tests\DataTrans\TestDataInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorInterface;

class StandardAuthorizationRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @param StandardAuthorizationRequest $hiddenAuthorizationRequest
     * @param int        $violationCount
     * @dataProvider standardAuthorizationRequestProvider
     */
    public function testValidationWithCardNo(StandardAuthorizationRequest $hiddenAuthorizationRequest, $violationCount)
    {
        $validator = $this->getValidator();
        $violations = $validator->validate($hiddenAuthorizationRequest);

        $this->assertEquals($violationCount, $violations->count());
    }

    public function testGetterSetterWithCardNo()
    {
        $this->getAuthorization()->createStandardAuthorizationRequest(
            TestDataInterface::MERCHANTID,
            TestDataInterface::AMOUNT,
            TestDataInterface::CURRENCY,
            TestDataInterface::REFNO,
            TestDataInterface::URL_SUCCESS,
            TestDataInterface::URL_FAILED,
            TestDataInterface::URL_CANCEL,
            TestDataInterface::SIGN
        );

        $hiddenAuthorizationRequest = new StandardAuthorizationRequest;

        $hiddenAuthorizationRequest->setMerchantId(TestDataInterface::MERCHANTID);
        $hiddenAuthorizationRequest->setAmount(TestDataInterface::AMOUNT);
        $hiddenAuthorizationRequest->setCurrency(TestDataInterface::CURRENCY);
        $hiddenAuthorizationRequest->setRefNo(TestDataInterface::REFNO);
        $hiddenAuthorizationRequest->setSign(TestDataInterface::SIGN);
        $hiddenAuthorizationRequest->setSuccessUrl(TestDataInterface::URL_SUCCESS);
        $hiddenAuthorizationRequest->setErrorUrl(TestDataInterface::URL_FAILED);
        $hiddenAuthorizationRequest->setCancelUrl(TestDataInterface::URL_CANCEL);
        $hiddenAuthorizationRequest->setUseAlias(DataInterface::BOOL_TRUE);
        $hiddenAuthorizationRequest->setLanguage('DE');
        $hiddenAuthorizationRequest->setReqType(DataInterface::REQTYPE_AUTHORIZATIONWITHIMMEDIATESETTLEMENT);
        $hiddenAuthorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
        $hiddenAuthorizationRequest->setUppMobileMode(DataInterface::STATUS_ENABLED);
        $hiddenAuthorizationRequest->setUseTouchUI(DataInterface::BOOL_TRUE);
        $hiddenAuthorizationRequest->setCustomTheme('theme55');
        $hiddenAuthorizationRequest->setMfaReference('010101');
        $hiddenAuthorizationRequest->setUppReturnMaskedCC(DataInterface::BOOL_TRUE);
        $hiddenAuthorizationRequest->setRefNo2(TestDataInterface::REFNO);
        $hiddenAuthorizationRequest->setRefNo3(TestDataInterface::REFNO);
        $hiddenAuthorizationRequest->setVirtualCardNo(TestDataInterface::CARDNUMBER);
        $hiddenAuthorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
        $hiddenAuthorizationRequest->setUppCustomerTitle('title');
        $hiddenAuthorizationRequest->setUppCustomerName('Name');
        $hiddenAuthorizationRequest->setUppCustomerFirstName(TestDataInterface::CUSTOMER_FIRSTNAME);
        $hiddenAuthorizationRequest->setUppCustomerLastName(TestDataInterface::CUSTOMER_LASTNAME);
        $hiddenAuthorizationRequest->setUppCustomerStreet(TestDataInterface::CUSTOMER_STREET);
        $hiddenAuthorizationRequest->setUppCustomerStreet2('Street 0');
        $hiddenAuthorizationRequest->setUppCustomerCity(TestDataInterface::CUSTOMER_CITY);
        $hiddenAuthorizationRequest->setUppCustomerCountry(TestDataInterface::CUSTOMER_COUNTRY);
        $hiddenAuthorizationRequest->setUppCustomerZipCode(TestDataInterface::CUSTOMER_ZIPCODE);
        $hiddenAuthorizationRequest->setUppCustomerPhone('0041000000000');
        $hiddenAuthorizationRequest->setUppCustomerFax('0041000000000');
        $hiddenAuthorizationRequest->setUppCustomerEmail(TestDataInterface::CUSTOMER_EMAIL);
        $hiddenAuthorizationRequest->setUppCustomerGender(DataInterface::GENDER_MALE);
        $hiddenAuthorizationRequest->setUppCustomerBirthDate(new \DateTime('01.01.1970'));
        $hiddenAuthorizationRequest->setUppCustomerLanguage(TestDataInterface::CUSTOMER_LANGUAGE);

        $this->assertEquals(TestDataInterface::MERCHANTID, $hiddenAuthorizationRequest->getMerchantId());
        $this->assertEquals(TestDataInterface::AMOUNT, $hiddenAuthorizationRequest->getAmount());
        $this->assertEquals(TestDataInterface::CURRENCY, $hiddenAuthorizationRequest->getCurrency());
        $this->assertEquals(TestDataInterface::REFNO, $hiddenAuthorizationRequest->getRefNo());
        $this->assertEquals(TestDataInterface::SIGN, $hiddenAuthorizationRequest->getSign());
        $this->assertEquals(TestDataInterface::URL_SUCCESS, $hiddenAuthorizationRequest->getSuccessUrl());
        $this->assertEquals(TestDataInterface::URL_FAILED, $hiddenAuthorizationRequest->getErrorUrl());
        $this->assertEquals(TestDataInterface::URL_CANCEL, $hiddenAuthorizationRequest->getCancelUrl());
        $this->assertEquals(DataInterface::BOOL_TRUE, $hiddenAuthorizationRequest->getUseAlias());
        $this->assertEquals('DE', $hiddenAuthorizationRequest->getLanguage());
        $this->assertEquals(DataInterface::REQTYPE_AUTHORIZATIONWITHIMMEDIATESETTLEMENT, $hiddenAuthorizationRequest->getReqType());
        $this->assertEquals(DataInterface::RESPONSEMETHOD_GET, $hiddenAuthorizationRequest->getUppWebResponseMethod());
        $this->assertEquals(DataInterface::STATUS_ENABLED, $hiddenAuthorizationRequest->getUppMobileMode());
        $this->assertEquals(DataInterface::BOOL_TRUE, $hiddenAuthorizationRequest->getUseTouchUI());
        $this->assertEquals('theme55', $hiddenAuthorizationRequest->getCustomTheme());
        $this->assertEquals('010101', $hiddenAuthorizationRequest->getMfaReference());
        $this->assertEquals(DataInterface::BOOL_TRUE, $hiddenAuthorizationRequest->getUppReturnMaskedCC());
        $this->assertEquals(TestDataInterface::REFNO, $hiddenAuthorizationRequest->getRefNo2());
        $this->assertEquals(TestDataInterface::REFNO, $hiddenAuthorizationRequest->getRefNo3());
        $this->assertEquals(TestDataInterface::CARDNUMBER, $hiddenAuthorizationRequest->getVirtualCardNo());
        $this->assertEquals(DataInterface::CUSTOMERDETAIL_TRUE, $hiddenAuthorizationRequest->getUppCustomerDetails());
        $this->assertEquals('title', $hiddenAuthorizationRequest->getUppCustomerTitle());
        $this->assertEquals('Name', $hiddenAuthorizationRequest->getUppCustomerName());
        $this->assertEquals(TestDataInterface::CUSTOMER_FIRSTNAME, $hiddenAuthorizationRequest->getUppCustomerFirstName());
        $this->assertEquals(TestDataInterface::CUSTOMER_LASTNAME, $hiddenAuthorizationRequest->getUppCustomerLastName());
        $this->assertEquals(TestDataInterface::CUSTOMER_STREET, $hiddenAuthorizationRequest->getUppCustomerStreet());
        $this->assertEquals('Street 0', $hiddenAuthorizationRequest->getUppCustomerStreet2());
        $this->assertEquals(TestDataInterface::CUSTOMER_CITY, $hiddenAuthorizationRequest->getUppCustomerCity());
        $this->assertEquals(TestDataInterface::CUSTOMER_COUNTRY, $hiddenAuthorizationRequest->getUppCustomerCountry());
        $this->assertEquals(TestDataInterface::CUSTOMER_ZIPCODE, $hiddenAuthorizationRequest->getUppCustomerZipCode());
        $this->assertEquals('0041000000000', $hiddenAuthorizationRequest->getUppCustomerPhone());
        $this->assertEquals('0041000000000', $hiddenAuthorizationRequest->getUppCustomerFax());
        $this->assertEquals(TestDataInterface::CUSTOMER_EMAIL, $hiddenAuthorizationRequest->getUppCustomerEmail());
        $this->assertEquals(DataInterface::GENDER_MALE, $hiddenAuthorizationRequest->getUppCustomerGender());
        $this->assertEquals(new \DateTime('01.01.1970'), $hiddenAuthorizationRequest->getUppCustomerBirthDate());
        $this->assertEquals(TestDataInterface::CUSTOMER_LANGUAGE, $hiddenAuthorizationRequest->getUppCustomerLanguage());

        $validator = $this->getValidator();
        $violations = $validator->validate($hiddenAuthorizationRequest);

        $this->assertEquals(0, $violations->count());
    }

    /**
     * @return array
     */
    public function standardAuthorizationRequestProvider()
    {
        return array(
            array(
                $this->getAuthorization()->createStandardAuthorizationRequest(
                    TestDataInterface::MERCHANTID,
                    TestDataInterface::AMOUNT,
                    TestDataInterface::CURRENCY,
                    TestDataInterface::REFNO,
                    TestDataInterface::URL_SUCCESS,
                    TestDataInterface::URL_FAILED,
                    TestDataInterface::URL_CANCEL,
                    TestDataInterface::SIGN
                ),
                0
            ),
            array(
                $this->getAuthorization()->createStandardAuthorizationRequest(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                4
            ),
        );
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
