<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Response;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\AbstractData;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

abstract class AbstractAuthorizationResponse extends AbstractData
{
    /**
     * @var string
     */
    protected $uppTransactionId;

    /**
     * @var string
     */
    protected $refNo;

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
    protected $status;

    /**
     * @var string
     */
    protected $uppMsgType;

    /**
     * @return string
     */
    public function getUppTransactionId()
    {
        return $this->uppTransactionId;
    }

    /**
     * @param string $uppTransactionId
     * @return $this
     */
    public function setUppTransactionId($uppTransactionId)
    {
        $this->uppTransactionId = $uppTransactionId;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getUppMsgType()
    {
        return $this->uppMsgType;
    }

    /**
     * @param string $uppMsgType
     * @return $this
     */
    public function setUppMsgType($uppMsgType)
    {
        $this->uppMsgType = $uppMsgType;
        return $this;
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidStatus(ExecutionContextInterface $context)
    {
        $status = $this->getStatus();

        if (!in_array($status, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'RESPONSESTATUS_')))) {
            $context->addViolationAt('status', "Unknown status '{$status}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    abstract public function isValidUppMsgType(ExecutionContextInterface $context);

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('uppTransactionId', new NotBlank());
        $metadata->addPropertyConstraint('uppTransactionId', new Length(array('min' => 18, 'max' => 18)));
        $metadata->addPropertyConstraint('uppTransactionId', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addPropertyConstraint('refNo', new NotBlank());
        $metadata->addPropertyConstraint('refNo', new Length(array('min' => 0, 'max' => 18)));
        $metadata->addPropertyConstraint('refNo', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('amount', new NotBlank());
        $metadata->addPropertyConstraint('amount', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addPropertyConstraint('currency', new NotBlank());
        $metadata->addPropertyConstraint('currency', new Length(array('min' => 3, 'max' => 3)));
        $metadata->addPropertyConstraint('currency', new Regex(array('pattern' => Pattern::ALPHA)));

        $metadata->addPropertyConstraint('status', new NotBlank());
        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidStatus'),
        )));

        $metadata->addPropertyConstraint('uppMsgType', new NotBlank());
        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidUppMsgType'),
        )));
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array(
            new MappingConfiguration('uppTransactionId', 'uppTransactionId'),
            new MappingConfiguration('refNo', 'refno'),
            new MappingConfiguration('amount', 'amount'),
            new MappingConfiguration('currency', 'currency'),
            new MappingConfiguration('status', 'status'),
            new MappingConfiguration('uppMsgType', 'uppMsgType'),
        );
    }
}
