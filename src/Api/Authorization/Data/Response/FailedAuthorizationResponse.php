<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Response;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class FailedAuthorizationResponse extends AbstractAuthorizationResponse
{
    /**
     * @var string
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @var string
     */
    protected $errorDetail;

    /**
     * @var string
     */
    protected $pMethod;

    /**
     * @var string
     */
    protected $reqType;

    /**
     * @var string
     */
    protected $acqErrorCode;

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param string $errorCode
     * @return $this
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorDetail()
    {
        return $this->errorDetail;
    }

    /**
     * @param string $errorDetail
     * @return $this
     */
    public function setErrorDetail($errorDetail)
    {
        $this->errorDetail = $errorDetail;
        return $this;
    }

    /**
     * @return string
     */
    public function getPMethod()
    {
        return $this->pMethod;
    }

    /**
     * @param string $pMethod
     * @return $this
     */
    public function setPMethod($pMethod)
    {
        $this->pMethod = $pMethod;
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
    public function getAcqErrorCode()
    {
        return $this->acqErrorCode;
    }

    /**
     * @param string $acqErrorCode
     * @return $this
     */
    public function setAcqErrorCode($acqErrorCode)
    {
        $this->acqErrorCode = $acqErrorCode;
        return $this;
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppMsgType(ExecutionContextInterface $context)
    {
        $uppMsgType = $this->getUppMsgType();

        if (!in_array($uppMsgType, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'MSGTYPE_')))) {
            $context->addViolationAt('status', "Unknown uppMsgType '{$uppMsgType}' given!");
        }
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidReqType(ExecutionContextInterface $context)
    {
        $reqType = $this->getReqType();

        if (!in_array($reqType, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix(__CLASS__, 'REQTYPE_')))) {
            $context->addViolationAt('status', "Unknown reqType '{$reqType}' given!");
        }
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('errorCode', new NotBlank());
        $metadata->addPropertyConstraint('errorCode', new Length(array('min' => 7, 'max' => 7)));
        $metadata->addPropertyConstraint('errorCode', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addPropertyConstraint('errorMessage', new NotBlank());

        $metadata->addPropertyConstraint('errorDetail', new NotBlank());

        $metadata->addPropertyConstraint('pMethod', new NotBlank());
        $metadata->addPropertyConstraint('pMethod', new Length(array('min' => 3, 'max' => 3)));
        $metadata->addPropertyConstraint('pMethod', new Regex(array('pattern' => Pattern::ALPHA)));

        $metadata->addPropertyConstraint('reqType', new NotBlank());
        $metadata->addConstraint(new Callback(array(
            'methods' => array('isValidReqType'),
        )));

        $metadata->addPropertyConstraint('acqErrorCode', new NotBlank());
        $metadata->addPropertyConstraint('acqErrorCode', new Regex(array('pattern' => Pattern::NUMERIC)));
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array_merge(parent::getMappingConfigurations(), array(
            new MappingConfiguration('errorCode', 'errorCode'),
            new MappingConfiguration('errorMessage', 'errorMessage'),
            new MappingConfiguration('errorDetail', 'errorDetail'),
            new MappingConfiguration('pMethod', 'pmethod'),
            new MappingConfiguration('reqType', 'reqType'),
            new MappingConfiguration('acqErrorCode', 'acqErrorCode'),
        ));
    }
}
