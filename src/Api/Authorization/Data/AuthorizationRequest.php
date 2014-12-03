<?php

namespace Ibrows\DataTrans\Api\Authorization\Data;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\AbstractData;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class AuthorizationRequest extends AbstractData
{
    /**
     * @var int
     */
    protected $merchantId;

    /**
     * @return int
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param int $merchantId
     * @return Authorization
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
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
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array(
            new MappingConfiguration('merchantId', 'merchantId'),
        );
    }
}