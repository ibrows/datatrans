<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Request;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class HiddenAuthorizationRequest extends AbstractAuthorizationRequest
{
    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var string
     */
    protected $cardNo;

    /**
     * @var string
     */
    protected $aliasCC;

    /**
     * @var string
     */
    protected $expm;

    /**
     * @var string
     */
    protected $expy;

    /**
     * @var string
     */
    protected $hiddenMode = self::BOOL_TRUE;

    /**
     * @var string
     */
    protected $cvv;

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardNo()
    {
        return $this->cardNo;
    }

    /**
     * @param string $cardNo
     * @return $this
     */
    public function setCardNo($cardNo)
    {
        $this->cardNo = $cardNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getAliasCC()
    {
        return $this->aliasCC;
    }

    /**
     * @param string $aliasCC
     * @return $this
     */
    public function setAliasCC($aliasCC)
    {
        $this->aliasCC = $aliasCC;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpm()
    {
        return $this->expm;
    }

    /**
     * @param string $expm
     * @return $this
     */
    public function setExpm($expm)
    {
        $this->expm = $expm;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpy()
    {
        return $this->expy;
    }

    /**
     * @param string $expy
     * @return $this
     */
    public function setExpy($expy)
    {
        $this->expy = $expy;
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
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     * @return $this
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidPaymentMethod(ExecutionContextInterface $context)
    {
        $paymentMethod = $this->getPaymentMethod();

        if (!in_array($paymentMethod, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'PAYMENTMETHOD_')))) {
            $context->addViolationAt('status', "Unknown paymentmethod '{$paymentMethod}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isCardNoOrAliasCC(ExecutionContextInterface $context)
    {
        if (null === $this->getCardNo() && null === $this->getAliasCC()) {
            $context->addViolationAt('cardNo', 'cardNo or aliasCC needs a value!');
        }

        if (null !== $this->getCardNo() && null !== $this->getAliasCC()) {
            $context->addViolationAt('aliasCC', 'Property aliasCC has to be null, if cardNo is given!');
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidExpm(ExecutionContextInterface $context)
    {
        $expm = $this->getExpm();

        if (!in_array($expm, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'MONTH_')))) {
            $context->addViolationAt('status', "Unknown expm '{$expm}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidExpy(ExecutionContextInterface $context)
    {
        $expy = $this->getExpy();

        $now = new \DateTime();
        $years = array();
        for ($i = 0; $i < 10; $i++) {
            $years[] = $now->format('y');
            $now->modify('+1year');
        }

        if (!in_array($expy, $years, true)) {
            $context->addViolationAt('status', "Invalid expy '{$expy}' given!");
        }
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('paymentMethod', new NotBlank());
        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidPaymentMethod'),
        )));

        $metadata->addPropertyConstraint('cardNo', new Length(array('min' => 0, 'max' => 20)));
        $metadata->addPropertyConstraint('cardNo', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('aliasCC', new Length(array('min' => 0, 'max' => 20)));
        $metadata->addPropertyConstraint('aliasCC', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addConstraint(new Callback(array(
            'methods' => array('isCardNoOrAliasCC'),
        )));

        $metadata->addPropertyConstraint('expm', new NotBlank());
        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidExpm'),
        )));

        $metadata->addPropertyConstraint('expy', new NotBlank());
        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidExpy'),
        )));

        $metadata->addPropertyConstraint('cvv', new NotBlank());
        $metadata->addPropertyConstraint('cvv', new Length(array('min' => 0, 'max' => 4)));
        $metadata->addPropertyConstraint('cvv', new Regex(array('pattern' => Pattern::NUMERIC)));
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array_merge(parent::getMappingConfigurations(), array(
            new MappingConfiguration('paymentMethod', 'paymentmethod'),
            new MappingConfiguration('cardNo', 'cardno'),
            new MappingConfiguration('aliasCC', 'aliasCC'),
            new MappingConfiguration('expm', 'expm'),
            new MappingConfiguration('expy', 'expy'),
            new MappingConfiguration('hiddenMode', 'hiddenMode'),
            new MappingConfiguration('cvv', 'cvv'),
        ));
    }
}
