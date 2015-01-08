<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Request;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\AbstractData;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

abstract class AbstractAuthorizationRequest extends AbstractData
{
    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var string
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $refNo;

    /**
     * @var string
     */
    protected $sign;

    /**
     * @var string
     */
    protected $successUrl;

    /**
     * @var string
     */
    protected $errorUrl;

    /**
     * @var string
     */
    protected $cancelUrl;

    /**
     * @var string
     */
    protected $useAlias;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $reqType;

    /**
     * @var string
     */
    protected $uppWebResponseMethod;

    /**
     * @var string
     */
    protected $uppMobileMode;

    /**
     * @var string
     */
    protected $useTouchUI;

    /**
     * @var string
     */
    protected $customTheme;

    /**
     * @var string
     */
    protected $mfaReference;

    /**
     * @var string
     */
    protected $uppReturnMaskedCC;

    /**
     * @var string
     */
    protected $refNo2;

    /**
     * @var string
     */
    protected $refNo3;

    /**
     * @var string
     */
    protected $virtualCardNo;

    /**
     * @var string
     */
    protected $uppCustomerDetails;

    /**
     * @var string
     */
    protected $uppCustomerTitle;

    /**
     * @var string
     */
    protected $uppCustomerName;

    /**
     * @var string
     */
    protected $uppCustomerFirstName;

    /**
     * @var string
     */
    protected $uppCustomerLastName;

    /**
     * @var string
     */
    protected $uppCustomerStreet;

    /**
     * @var string
     */
    protected $uppCustomerStreet2;

    /**
     * @var string
     */
    protected $uppCustomerCity;

    /**
     * @var string
     */
    protected $uppCustomerCountry;

    /**
     * @var string
     */
    protected $uppCustomerZipCode;

    /**
     * @var string
     */
    protected $uppCustomerPhone;

    /**
     * @var string
     */
    protected $uppCustomerFax;

    /**
     * @var string
     */
    protected $uppCustomerEmail;

    /**
     * @var string
     */
    protected $uppCustomerGender;

    /**
     * @var string
     */
    protected $uppCustomerBirthDate;

    /**
     * @var string
     */
    protected $uppCustomerLanguage;

    /**
     * @var string
     */
    protected $hiddenMode = self::BOOL_TRUE;

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefNo()
    {
        return $this->refNo;
    }

    /**
     * @param string $refNo
     * @return $this
     */
    public function setRefNo($refNo)
    {
        $this->refNo = $refNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @param string $sign
     * @return $this
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param string $successUrl
     * @return $this
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorUrl()
    {
        return $this->errorUrl;
    }

    /**
     * @param string $errorUrl
     * @return $this
     */
    public function setErrorUrl($errorUrl)
    {
        $this->errorUrl = $errorUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * @param string $cancelUrl
     * @return $this
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getUseAlias()
    {
        return $this->useAlias;
    }

    /**
     * @param string $useAlias
     * @return $this
     */
    public function setUseAlias($useAlias)
    {
        $this->useAlias = $useAlias;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getReqType()
    {
        return $this->reqType;
    }

    /**
     * @param string $reqType
     * @return $this
     */
    public function setReqType($reqType)
    {
        $this->reqType = $reqType;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppWebResponseMethod()
    {
        return $this->uppWebResponseMethod;
    }

    /**
     * @param string $uppWebResponseMethod
     * @return $this
     */
    public function setUppWebResponseMethod($uppWebResponseMethod)
    {
        $this->uppWebResponseMethod = $uppWebResponseMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppMobileMode()
    {
        return $this->uppMobileMode;
    }

    /**
     * @param string $uppMobileMode
     * @return $this
     */
    public function setUppMobileMode($uppMobileMode)
    {
        $this->uppMobileMode = $uppMobileMode;
        return $this;
    }

    /**
     * @return string
     */
    public function getUseTouchUI()
    {
        return $this->useTouchUI;
    }

    /**
     * @param string $useTouchUI
     * @return $this
     */
    public function setUseTouchUI($useTouchUI)
    {
        $this->useTouchUI = $useTouchUI;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomTheme()
    {
        return $this->customTheme;
    }

    /**
     * @param string $customTheme
     * @return $this
     */
    public function setCustomTheme($customTheme)
    {
        $this->customTheme = $customTheme;
        return $this;
    }

    /**
     * @return string
     */
    public function getMfaReference()
    {
        return $this->mfaReference;
    }

    /**
     * @param string $mfaReference
     * @return $this
     */
    public function setMfaReference($mfaReference)
    {
        $this->mfaReference = $mfaReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppReturnMaskedCC()
    {
        return $this->uppReturnMaskedCC;
    }

    /**
     * @param string $uppReturnMaskedCC
     * @return $this
     */
    public function setUppReturnMaskedCC($uppReturnMaskedCC)
    {
        $this->uppReturnMaskedCC = $uppReturnMaskedCC;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefNo2()
    {
        return $this->refNo2;
    }

    /**
     * @param string $refNo2
     * @return $this
     */
    public function setRefNo2($refNo2)
    {
        $this->refNo2 = $refNo2;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefNo3()
    {
        return $this->refNo3;
    }

    /**
     * @param string $refNo3
     * @return $this
     */
    public function setRefNo3($refNo3)
    {
        $this->refNo3 = $refNo3;
        return $this;
    }

    /**
     * @return string
     */
    public function getVirtualCardNo()
    {
        return $this->virtualCardNo;
    }

    /**
     * @param string $virtualCardNo
     * @return $this
     */
    public function setVirtualCardNo($virtualCardNo)
    {
        $this->virtualCardNo = $virtualCardNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerDetails()
    {
        return $this->uppCustomerDetails;
    }

    /**
     * @param string $uppCustomerDetails
     * @return $this
     */
    public function setUppCustomerDetails($uppCustomerDetails)
    {
        $this->uppCustomerDetails = $uppCustomerDetails;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerTitle()
    {
        return $this->uppCustomerTitle;
    }

    /**
     * @param string $uppCustomerTitle
     * @return $this
     */
    public function setUppCustomerTitle($uppCustomerTitle)
    {
        $this->uppCustomerTitle = $uppCustomerTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerName()
    {
        return $this->uppCustomerName;
    }

    /**
     * @param string $uppCustomerName
     * @return $this
     */
    public function setUppCustomerName($uppCustomerName)
    {
        $this->uppCustomerName = $uppCustomerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerFirstName()
    {
        return $this->uppCustomerFirstName;
    }

    /**
     * @param string $uppCustomerFirstName
     * @return $this
     */
    public function setUppCustomerFirstName($uppCustomerFirstName)
    {
        $this->uppCustomerFirstName = $uppCustomerFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerLastName()
    {
        return $this->uppCustomerLastName;
    }

    /**
     * @param string $uppCustomerLastName
     * @return $this
     */
    public function setUppCustomerLastName($uppCustomerLastName)
    {
        $this->uppCustomerLastName = $uppCustomerLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerStreet()
    {
        return $this->uppCustomerStreet;
    }

    /**
     * @param string $uppCustomerStreet
     * @return $this
     */
    public function setUppCustomerStreet($uppCustomerStreet)
    {
        $this->uppCustomerStreet = $uppCustomerStreet;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerStreet2()
    {
        return $this->uppCustomerStreet2;
    }

    /**
     * @param string $uppCustomerStreet2
     * @return $this
     */
    public function setUppCustomerStreet2($uppCustomerStreet2)
    {
        $this->uppCustomerStreet2 = $uppCustomerStreet2;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerCity()
    {
        return $this->uppCustomerCity;
    }

    /**
     * @param string $uppCustomerCity
     * @return $this
     */
    public function setUppCustomerCity($uppCustomerCity)
    {
        $this->uppCustomerCity = $uppCustomerCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerCountry()
    {
        return $this->uppCustomerCountry;
    }

    /**
     * @param string $uppCustomerCountry
     * @return $this
     */
    public function setUppCustomerCountry($uppCustomerCountry)
    {
        $this->uppCustomerCountry = $uppCustomerCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerZipCode()
    {
        return $this->uppCustomerZipCode;
    }

    /**
     * @param string $uppCustomerZipCode
     * @return $this
     */
    public function setUppCustomerZipCode($uppCustomerZipCode)
    {
        $this->uppCustomerZipCode = $uppCustomerZipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerPhone()
    {
        return $this->uppCustomerPhone;
    }

    /**
     * @param string $uppCustomerPhone
     * @return $this
     */
    public function setUppCustomerPhone($uppCustomerPhone)
    {
        $this->uppCustomerPhone = $uppCustomerPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerFax()
    {
        return $this->uppCustomerFax;
    }

    /**
     * @param string $uppCustomerFax
     * @return $this
     */
    public function setUppCustomerFax($uppCustomerFax)
    {
        $this->uppCustomerFax = $uppCustomerFax;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerEmail()
    {
        return $this->uppCustomerEmail;
    }

    /**
     * @param string $uppCustomerEmail
     * @return $this
     */
    public function setUppCustomerEmail($uppCustomerEmail)
    {
        $this->uppCustomerEmail = $uppCustomerEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerGender()
    {
        return $this->uppCustomerGender;
    }

    /**
     * @param string $uppCustomerGender
     * @return $this
     */
    public function setUppCustomerGender($uppCustomerGender)
    {
        $this->uppCustomerGender = $uppCustomerGender;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUppCustomerBirthDate()
    {
        return $this->uppCustomerBirthDate;
    }

    /**
     * @param \DateTime $uppCustomerBirthDate
     * @return $this
     */
    public function setUppCustomerBirthDate(\DateTime $uppCustomerBirthDate = null)
    {
        $this->uppCustomerBirthDate = $uppCustomerBirthDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppCustomerLanguage()
    {
        return $this->uppCustomerLanguage;
    }

    /**
     * @param string $uppCustomerLanguage
     * @return $this
     */
    public function setUppCustomerLanguage($uppCustomerLanguage)
    {
        $this->uppCustomerLanguage = $uppCustomerLanguage;
        return $this;
    }

    /**
     * @return string
     */
    public function getHiddenMode()
    {
        return $this->hiddenMode;
    }

    /**
     * @param string $hiddenMode
     * @return $this
     */
    public function setHiddenMode($hiddenMode)
    {
        $this->hiddenMode = $hiddenMode;
        return $this;
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidAlias(ExecutionContextInterface $context)
    {
        if (null === $alias = $this->getUseAlias()) {
            return;
        }

        if (!in_array($alias, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'BOOL_')))) {
            $context->addViolationAt('alias', "Unknown alias '{$alias}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidReqType(ExecutionContextInterface $context)
    {
        if (null === $reqType = $this->getReqType()) {
            return;
        }

        if (!in_array($reqType, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'REQTYPE_')))) {
            $context->addViolationAt('reqType', "Unknown reqType '{$reqType}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppWebResponseMethod(ExecutionContextInterface $context)
    {
        if (null === $uppWebResponseMethod = $this->getUppWebResponseMethod()) {
            return;
        }

        if (!in_array($uppWebResponseMethod, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'RESPONSEMETHOD_')))) {
            $context->addViolationAt('uppWebResponseMethod', "Unknown uppWebResponseMethod '{$uppWebResponseMethod}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppMobileMode(ExecutionContextInterface $context)
    {
        if (null === $uppMobileMode = $this->getUppMobileMode()) {
            return;
        }

        if (!in_array($uppMobileMode, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'STATUS_')))) {
            $context->addViolationAt('uppMobileMode', "Unknown uppMobileMode '{$uppMobileMode}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppTouchUI(ExecutionContextInterface $context)
    {
        if (null === $uppTouchUI = $this->getUseTouchUI()) {
            return;
        }

        if (!in_array($uppTouchUI, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'BOOL_')))) {
            $context->addViolationAt('uppTouchUI', "Unknown uppTouchUI '{$uppTouchUI}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppReturnMaskedCC(ExecutionContextInterface $context)
    {
        if (null === $uppReturnMaskedCC = $this->getUppReturnMaskedCC()) {
            return;
        }

        if (!in_array($uppReturnMaskedCC, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'BOOL_')))) {
            $context->addViolationAt('uppReturnMaskedCC', "Unknown uppReturnMaskedCC '{$uppReturnMaskedCC}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppCustomerDetails(ExecutionContextInterface $context)
    {
        if (null === $uppCustomerDetails = $this->getUppCustomerDetails()) {
            return;
        }

        if (!in_array($uppCustomerDetails, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'CUSTOMERDETAIL_')))) {
            $context->addViolationAt('uppCustomerDetails', "Unknown uppCustomerDetails '{$uppCustomerDetails}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppCustomerGender(ExecutionContextInterface $context)
    {
        if (null === $uppCustomerGender = $this->getUppCustomerGender()) {
            return;
        }

        if (!in_array($uppCustomerGender, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'GENDER_')))) {
            $context->addViolationAt('uppCustomerGender', "Unknown uppCustomerGender '{$uppCustomerGender}' given!");
        }
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('merchantId', new NotBlank());
        $metadata->addPropertyConstraint('merchantId', new Length(array('min' => 10, 'max' => 10)));
        $metadata->addPropertyConstraint('merchantId', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addPropertyConstraint('amount', new NotBlank());
        $metadata->addPropertyConstraint('amount', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addPropertyConstraint('currency', new NotBlank());
        $metadata->addPropertyConstraint('currency', new Length(array('min' => 3, 'max' => 3)));
        $metadata->addPropertyConstraint('currency', new Regex(array('pattern' => Pattern::ALPHA)));

        $metadata->addPropertyConstraint('refNo', new NotBlank());
        $metadata->addPropertyConstraint('refNo', new Length(array('min' => 0, 'max' => 18)));
        $metadata->addPropertyConstraint('refNo', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidAlias'),
        )));

        $metadata->addPropertyConstraint('language', new Length(array('min' => 2, 'max' => 2)));
        $metadata->addPropertyConstraint('language', new Regex(array('pattern' => Pattern::ALPHA)));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidReqType'),
        )));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidUppWebResponseMethod'),
        )));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidUppMobileMode'),
        )));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidUppTouchUI'),
        )));

        $metadata->addPropertyConstraint('customTheme', new Length(array('min' => 0, 'max' => 50)));
        $metadata->addPropertyConstraint('customTheme', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('mfaReference', new Length(array('min' => 0, 'max' => 10)));
        $metadata->addPropertyConstraint('mfaReference', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidUppReturnMaskedCC'),
        )));

        $metadata->addPropertyConstraint('refNo2', new Length(array('min' => 0, 'max' => 27)));
        $metadata->addPropertyConstraint('refNo2', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('refNo3', new Length(array('min' => 0, 'max' => 27)));
        $metadata->addPropertyConstraint('refNo3', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('virtualCardNo', new Length(array('min' => 0, 'max' => 19)));
        $metadata->addPropertyConstraint('virtualCardNo', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidUppCustomerDetails'),
        )));

        $metadata->addPropertyConstraint('uppCustomerTitle', new Length(array('min' => 0, 'max' => 30)));
        $metadata->addPropertyConstraint('uppCustomerTitle', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerName', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerName', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerFirstName', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerFirstName', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerLastName', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerLastName', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerStreet', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerStreet', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerStreet2', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerStreet2', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerCity', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerCity', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerCountry', new Length(array('min' => 3, 'max' => 3)));
        $metadata->addPropertyConstraint('uppCustomerCountry', new Regex(array('pattern' => Pattern::ALPHA)));

        $metadata->addPropertyConstraint('uppCustomerZipCode', new Length(array('min' => 0, 'max' => 10)));
        $metadata->addPropertyConstraint('uppCustomerZipCode', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerPhone', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerPhone', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerFax', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerFax', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('uppCustomerEmail', new Length(array('min' => 0, 'max' => 40)));
        $metadata->addPropertyConstraint('uppCustomerEmail', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidUppCustomerGender'),
        )));

        $metadata->addPropertyConstraint('uppCustomerLanguage', new Length(array('min' => 2, 'max' => 2)));
        $metadata->addPropertyConstraint('uppCustomerLanguage', new Regex(array('pattern' => Pattern::ALPHA)));
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array(
            new MappingConfiguration('merchantId', 'merchantId'),
            new MappingConfiguration('amount', 'amount'),
            new MappingConfiguration('currency', 'currency'),
            new MappingConfiguration('refNo', 'refno'),
            new MappingConfiguration('sign', 'sign'),
            new MappingConfiguration('successUrl', 'successUrl'),
            new MappingConfiguration('errorUrl', 'errorUrl'),
            new MappingConfiguration('cancelUrl', 'cancelUrl'),
            new MappingConfiguration('useAlias', 'useAlias'),
            new MappingConfiguration('language', 'language'),
            new MappingConfiguration('reqType', 'reqtype'),
            new MappingConfiguration('uppWebResponseMethod', 'uppWebResponseMethod'),
            new MappingConfiguration('uppMobileMode', 'uppMobileMode'),
            new MappingConfiguration('useTouchUI', 'useTouchUI'),
            new MappingConfiguration('customTheme', 'customTheme'),
            new MappingConfiguration('mfaReference', 'mfaReference'),
            new MappingConfiguration('uppReturnMaskedCC', 'uppReturnMaskedCC'),
            new MappingConfiguration('refNo2', 'refno2'),
            new MappingConfiguration('refNo3', 'refno3'),
            new MappingConfiguration('virtualCardNo', 'virtualCardno'),
            new MappingConfiguration('uppCustomerDetails', 'uppCustomerDetails'),
            new MappingConfiguration('uppCustomerTitle', 'uppCustomerTitle'),
            new MappingConfiguration('uppCustomerName', 'uppCustomerName'),
            new MappingConfiguration('uppCustomerFirstName', 'uppCustomerFirstName'),
            new MappingConfiguration('uppCustomerLastName', 'uppCustomerLastName'),
            new MappingConfiguration('uppCustomerStreet', 'uppCustomerStreet'),
            new MappingConfiguration('uppCustomerStreet2', 'uppCustomerStreet2'),
            new MappingConfiguration('uppCustomerCity', 'uppCustomerCity'),
            new MappingConfiguration('uppCustomerCountry', 'uppCustomerCountry'),
            new MappingConfiguration('uppCustomerZipCode', 'uppCustomerZipCode'),
            new MappingConfiguration('uppCustomerPhone', 'uppCustomerPhone'),
            new MappingConfiguration('uppCustomerFax', 'uppCustomerFax'),
            new MappingConfiguration('uppCustomerEmail', 'uppCustomerEmail'),
            new MappingConfiguration('uppCustomerGender', 'uppCustomerGender'),
            new MappingConfiguration('uppCustomerBirthDate', 'uppCustomerBirthDate'),
            new MappingConfiguration('uppCustomerLanguage', 'uppCustomerLanguage'),
            new MappingConfiguration('hiddenMode', 'hiddenMode'),
        );
    }
}
