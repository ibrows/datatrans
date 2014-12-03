<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Request;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\AbstractData;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
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
        );
    }
}