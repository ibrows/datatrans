<?php

namespace Ibrows\DataTrans\Api\Authorization\Data;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SuccessfulAuthorizationResponse extends AbstractAuthorizationResponse
{
    /**
     * @var int
     */
    protected $responseCode;

    /**
     * @var string
     */
    protected $responseMessage;

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
    protected $acqAuthorizationCode;

    /**
     * @var string
     */
    protected $aliasCC;

    /**
     * @var string
     */
    protected $maskedCC;

    /**
     * @var string
     */
    protected $sign2;

    /**
     * @var int
     */
    protected $virtualCardNo;

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @param int $responseCode
     * @return $this
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponseMessage()
    {
        return $this->responseMessage;
    }

    /**
     * @param string $responseMessage
     * @return $this
     */
    public function setResponseMessage($responseMessage)
    {
        $this->responseMessage = $responseMessage;
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
    public function getAcqAuthorizationCode()
    {
        return $this->acqAuthorizationCode;
    }

    /**
     * @param string $acqAuthorizationCode
     * @return $this
     */
    public function setAcqAuthorizationCode($acqAuthorizationCode)
    {
        $this->acqAuthorizationCode = $acqAuthorizationCode;
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
    public function getMaskedCC()
    {
        return $this->maskedCC;
    }

    /**
     * @param string $maskedCC
     * @return $this
     */
    public function setMaskedCC($maskedCC)
    {
        $this->maskedCC = $maskedCC;
        return $this;
    }

    /**
     * @return string
     */
    public function getSign2()
    {
        return $this->sign2;
    }

    /**
     * @param string $sign2
     * @return $this
     */
    public function setSign2($sign2)
    {
        $this->sign2 = $sign2;
        return $this;
    }

    /**
     * @return int
     */
    public function getVirtualCardNo()
    {
        return $this->virtualCardNo;
    }

    /**
     * @param int $virtualCardNo
     * @return $this
     */
    public function setVirtualCardNo($virtualCardNo)
    {
        $this->virtualCardNo = $virtualCardNo;
        return $this;
    }

    /**
     * @param ExecutionContextInterface $context
     */
    public function isValidUppMsgType(ExecutionContextInterface $context)
    {
        $uppMsgType = $this->getUppMsgType();

        if (!in_array($uppMsgType, array_keys(\Dominikzogg\ClassHelpers\getConstantsWithPrefix('Ibrows\DataTrans\Constants', 'MSGTYPE_')))) {
            $context->addViolationAt('status', "Unknown uppMsgType '{$uppMsgType}' given!");
        }
    }

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('responseCode', new NotBlank());
        $metadata->addPropertyConstraint('responseCode', new Length(array('min' => 4, 'max' => 4)));
        $metadata->addPropertyConstraint('responseCode', new Regex(array('pattern' => Pattern::NUMERIC)));

        $metadata->addPropertyConstraint('responseMessage', new NotBlank());

        $metadata->addPropertyConstraint('pMethod', new NotBlank());
        $metadata->addPropertyConstraint('pMethod', new Length(array('min' => 3, 'max' => 3)));
        $metadata->addPropertyConstraint('pMethod', new Regex(array('pattern' => Pattern::ALPHA)));

        $metadata->addPropertyConstraint('reqType', new NotBlank());
        $metadata->addPropertyConstraint('reqType', new Length(array('min' => 3, 'max' => 3)));
        $metadata->addPropertyConstraint('reqType', new Regex(array('pattern' => Pattern::ALPHA)));

        $metadata->addPropertyConstraint('acqAuthorizationCode', new NotBlank());
        $metadata->addPropertyConstraint('acqAuthorizationCode', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('aliasCC', new Length(array('min' => 20, 'max' => 20)));
        $metadata->addPropertyConstraint('aliasCC', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));

        $metadata->addPropertyConstraint('virtualCardNo', new Length(array('min' => 19, 'max' => 19)));
        $metadata->addPropertyConstraint('virtualCardNo', new Regex(array('pattern' => Pattern::NUMERIC)));
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array_merge(parent::getMappingConfigurations(), array(
            new MappingConfiguration('responseCode', 'responseCode'),
            new MappingConfiguration('responseMessage', 'responseMessage'),
            new MappingConfiguration('pMethod', 'pmethod'),
            new MappingConfiguration('reqType', 'reqType'),
            new MappingConfiguration('acqAuthorizationCode', 'acqAuthorizationCode'),
            new MappingConfiguration('aliasCC', 'aliasCC'),
            new MappingConfiguration('maskedCC', 'maskedCC'),
            new MappingConfiguration('sign2', 'sign2'),
            new MappingConfiguration('virtualCardNo', 'virtualCardno'),
        ));
    }
}