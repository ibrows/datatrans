<?php

namespace Ibrows\DataTrans\Serializer;

class MappingConfiguration
{
    /**
     * @var string
     */
    protected $propertyName;

    /**
     * @var string
     */
    protected $serializedName;

    /**
     * @param string $propertyName
     * @param string $serializedName
     */
    public function __construct($propertyName, $serializedName)
    {
        $this->propertyName = $propertyName;
        $this->serializedName = $serializedName;
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @return string
     */
    public function getSerializedName()
    {
        return $this->serializedName;
    }
}
