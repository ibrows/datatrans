<?php

namespace Ibrows\DataTrans\Serializer;

use Ibrows\DataTrans\Error\DataTransErrorHandler;
use Ibrows\DataTrans\Error\DataTransSerializeException;

abstract class AbstractData implements MappingInterface
{
    /**
     * @return MappingConfiguration[]
     */
    abstract public function getMappingConfigurations();

    /**
     * @param  DataTransErrorHandler       $errorHandler
     * @throws DataTransSerializeException
     */
    public function validateMappingConfiguration(DataTransErrorHandler $errorHandler)
    {
        $propertyNames = array();
        $serializedNames = array();

        foreach ($this->getMappingConfigurations() as $mappingConfiguration) {
            $propertyName = $mappingConfiguration->getPropertyName();
            $serializedName = $mappingConfiguration->getSerializedName();

            if (!property_exists($this, $propertyName)) {
                $errorHandler->mappingNotFoundPropertyName($this, $propertyName);
            }

            if (in_array($propertyName, $propertyNames, true)) {
                $errorHandler->mappingDuplicatePropertyName($this, $propertyName);
            }

            if (in_array($serializedName, $serializedNames, true)) {
                $errorHandler->mappingDuplicateSerializedName($this, $serializedName);
            }
        }
    }

    /**
     * @return array
     */
    public function getMappedData()
    {
        $data = array();
        foreach ($this->getMappingConfigurations() as $mappingConfiguration) {
            $propertyName = $mappingConfiguration->getPropertyName();
            $serializedName = $mappingConfiguration->getSerializedName();

            $data[$serializedName] = $this->$propertyName;
        }

        return $data;
    }

    /**
     * @param  array  $data
     * @return static
     */
    public function setMappedData(array $data)
    {
        foreach ($this->getMappingConfigurations() as $mappingConfiguration) {
            $propertyName = $mappingConfiguration->getPropertyName();
            $serializedName = $mappingConfiguration->getSerializedName();

            if (isset($data[$serializedName])) {
                $this->$propertyName = $data[$serializedName];
            }
        }
    }
}
