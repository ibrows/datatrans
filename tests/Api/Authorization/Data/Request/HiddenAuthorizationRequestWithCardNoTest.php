<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization\Data\Request;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequestWithCardNo;
use Ibrows\DataTrans\DataInterface;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Ibrows\Tests\DataTrans\TestDataInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorInterface;

class HiddenAuthorizationRequestWithCardNoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @param HiddenAuthorizationRequestWithCardNo $request
     * @param int        $violationCount
     * @dataProvider hiddenAuthorizationRequestWithCardNoValidationProvider
     */
    public function testValidationWithCardNo(HiddenAuthorizationRequestWithCardNo $request, $violationCount)
    {
        $validator = $this->getValidator();
        $violations = $validator->validate($request);

        $this->assertEquals($violationCount, $violations->count());
    }

    public function testGetterSetterWithCardNo()
    {
        $this->getAuthorization()->createHiddenAuthorizationRequestWithCardNo(
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
            TestDataInterface::CVV,
            TestDataInterface::SIGN
        );

        $request = new HiddenAuthorizationRequestWithCardNo;

        $request->setMerchantId(TestDataInterface::MERCHANTID);
        $request->setAmount(TestDataInterface::AMOUNT);
        $request->setCurrency(TestDataInterface::CURRENCY);
        $request->setRefNo(TestDataInterface::REFNO);
        $request->setSign(TestDataInterface::SIGN);
        $request->setSuccessUrl(TestDataInterface::URL_SUCCESS);
        $request->setErrorUrl(TestDataInterface::URL_FAILED);
        $request->setCancelUrl(TestDataInterface::URL_CANCEL);
        $request->setUseAlias(DataInterface::BOOL_TRUE);
        $request->setLanguage('DE');
        $request->setReqType(DataInterface::REQTYPE_AUTHORIZATIONWITHIMMEDIATESETTLEMENT);
        $request->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
        $request->setUppMobileMode(DataInterface::STATUS_ENABLED);
        $request->setUseTouchUI(DataInterface::BOOL_TRUE);
        $request->setCustomTheme('theme55');
        $request->setMfaReference('010101');
        $request->setUppReturnMaskedCC(DataInterface::BOOL_TRUE);
        $request->setRefNo2(TestDataInterface::REFNO);
        $request->setRefNo3(TestDataInterface::REFNO);
        $request->setVirtualCardNo(TestDataInterface::CARDNUMBER);
        $request->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
        $request->setUppCustomerTitle('title');
        $request->setUppCustomerName('Name');
        $request->setUppCustomerFirstName(TestDataInterface::CUSTOMER_FIRSTNAME);
        $request->setUppCustomerLastName(TestDataInterface::CUSTOMER_LASTNAME);
        $request->setUppCustomerStreet(TestDataInterface::CUSTOMER_STREET);
        $request->setUppCustomerStreet2('Street 0');
        $request->setUppCustomerCity(TestDataInterface::CUSTOMER_CITY);
        $request->setUppCustomerCountry(TestDataInterface::CUSTOMER_COUNTRY);
        $request->setUppCustomerZipCode(TestDataInterface::CUSTOMER_ZIPCODE);
        $request->setUppCustomerPhone('0041000000000');
        $request->setUppCustomerFax('0041000000000');
        $request->setUppCustomerEmail(TestDataInterface::CUSTOMER_EMAIL);
        $request->setUppCustomerGender(DataInterface::GENDER_MALE);
        $request->setUppCustomerBirthDate(new \DateTime('01.01.1970'));
        $request->setUppCustomerLanguage(TestDataInterface::CUSTOMER_LANGUAGE);

        $request->setPaymentMethod(TestDataInterface::PAYMENTMETHOD);
        $request->setCardNo(TestDataInterface::CARDNUMBER);
        $request->setExpm(TestDataInterface::EXPM);
        $request->setExpy(TestDataInterface::EXPY);
        $request->setCvv(TestDataInterface::CVV);

        $this->assertEquals(TestDataInterface::MERCHANTID, $request->getMerchantId());
        $this->assertEquals(TestDataInterface::AMOUNT, $request->getAmount());
        $this->assertEquals(TestDataInterface::CURRENCY, $request->getCurrency());
        $this->assertEquals(TestDataInterface::REFNO, $request->getRefNo());
        $this->assertEquals(TestDataInterface::SIGN, $request->getSign());
        $this->assertEquals(TestDataInterface::URL_SUCCESS, $request->getSuccessUrl());
        $this->assertEquals(TestDataInterface::URL_FAILED, $request->getErrorUrl());
        $this->assertEquals(TestDataInterface::URL_CANCEL, $request->getCancelUrl());
        $this->assertEquals(DataInterface::BOOL_TRUE, $request->getUseAlias());
        $this->assertEquals('DE', $request->getLanguage());
        $this->assertEquals(DataInterface::REQTYPE_AUTHORIZATIONWITHIMMEDIATESETTLEMENT, $request->getReqType());
        $this->assertEquals(DataInterface::RESPONSEMETHOD_GET, $request->getUppWebResponseMethod());
        $this->assertEquals(DataInterface::STATUS_ENABLED, $request->getUppMobileMode());
        $this->assertEquals(DataInterface::BOOL_TRUE, $request->getUseTouchUI());
        $this->assertEquals('theme55', $request->getCustomTheme());
        $this->assertEquals('010101', $request->getMfaReference());
        $this->assertEquals(DataInterface::BOOL_TRUE, $request->getUppReturnMaskedCC());
        $this->assertEquals(TestDataInterface::REFNO, $request->getRefNo2());
        $this->assertEquals(TestDataInterface::REFNO, $request->getRefNo3());
        $this->assertEquals(TestDataInterface::CARDNUMBER, $request->getVirtualCardNo());
        $this->assertEquals(DataInterface::CUSTOMERDETAIL_TRUE, $request->getUppCustomerDetails());
        $this->assertEquals('title', $request->getUppCustomerTitle());
        $this->assertEquals('Name', $request->getUppCustomerName());
        $this->assertEquals(TestDataInterface::CUSTOMER_FIRSTNAME, $request->getUppCustomerFirstName());
        $this->assertEquals(TestDataInterface::CUSTOMER_LASTNAME, $request->getUppCustomerLastName());
        $this->assertEquals(TestDataInterface::CUSTOMER_STREET, $request->getUppCustomerStreet());
        $this->assertEquals('Street 0', $request->getUppCustomerStreet2());
        $this->assertEquals(TestDataInterface::CUSTOMER_CITY, $request->getUppCustomerCity());
        $this->assertEquals(TestDataInterface::CUSTOMER_COUNTRY, $request->getUppCustomerCountry());
        $this->assertEquals(TestDataInterface::CUSTOMER_ZIPCODE, $request->getUppCustomerZipCode());
        $this->assertEquals('0041000000000', $request->getUppCustomerPhone());
        $this->assertEquals('0041000000000', $request->getUppCustomerFax());
        $this->assertEquals(TestDataInterface::CUSTOMER_EMAIL, $request->getUppCustomerEmail());
        $this->assertEquals(DataInterface::GENDER_MALE, $request->getUppCustomerGender());
        $this->assertEquals(new \DateTime('01.01.1970'), $request->getUppCustomerBirthDate());
        $this->assertEquals(TestDataInterface::CUSTOMER_LANGUAGE, $request->getUppCustomerLanguage());

        $this->assertEquals(TestDataInterface::PAYMENTMETHOD, $request->getPaymentMethod());
        $this->assertEquals(TestDataInterface::CARDNUMBER, $request->getCardNo());
        $this->assertEquals(TestDataInterface::EXPM, $request->getExpm());
        $this->assertEquals(TestDataInterface::EXPY, $request->getExpy());
        $this->assertEquals(TestDataInterface::CVV, $request->getCvv());

        $validator = $this->getValidator();
        $violations = $validator->validate($request);

        $this->assertEquals(0, $violations->count());
    }

    /**
     * @return array
     */
    public function hiddenAuthorizationRequestWithCardNoValidationProvider()
    {
        return array(
            array(
                $this->getAuthorization()->createHiddenAuthorizationRequestWithCardNo(
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
                    TestDataInterface::CVV,
                    TestDataInterface::SIGN
                ),
                0
            ),
            array(
                $this->getAuthorization()->createHiddenAuthorizationRequestWithCardNo(
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
                ),
                16
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
