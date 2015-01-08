<?php

namespace Ibrows\DataTrans\Api\Authorization\Data\Request;

use Ibrows\DataTrans\Pattern;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class HiddenAuthorizationRequestWithAliasCC extends AbstractAuthorizationRequest
{
    /**
     * @var string
     */
    protected $aliasCC;

    /**
     * @var string
     */
    protected $hiddenMode = self::BOOL_TRUE;

    /**
     * @param string $merchantId
     * @param string $amount
     * @param string $currency
     * @param string $refNo
     * @param string $successUrl
     * @param string $errorUrl
     * @param string $cancelUrl
     * @param string $aliasCC
     * @param string $sign
     * @return static
     */
    public static function createValidInstance(
        $merchantId,
        $amount,
        $currency,
        $refNo,
        $successUrl,
        $errorUrl,
        $cancelUrl,
        $aliasCC,
        $sign = null
    ) {
        $instance = new static();

        $instance->setMerchantId($merchantId);
        $instance->setAmount($amount);
        $instance->setCurrency($currency);
        $instance->setRefNo($refNo);
        $instance->setSuccessUrl($successUrl);
        $instance->setErrorUrl($errorUrl);
        $instance->setCancelUrl($cancelUrl);
        $instance->setAliasCC($aliasCC);
        $instance->setSign($sign);

        return $instance;
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
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('aliasCC', new NotBlank());
        $metadata->addPropertyConstraint('aliasCC', new Length(array('min' => 0, 'max' => 20)));
        $metadata->addPropertyConstraint('aliasCC', new Regex(array('pattern' => Pattern::ALPHA_NUMERIC)));
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array_merge(parent::getMappingConfigurations(), array(
            new MappingConfiguration('aliasCC', 'aliasCC'),
        ));
    }
}
