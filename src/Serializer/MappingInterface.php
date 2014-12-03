<?php

namespace Ibrows\DataTrans\Serializer;

use Ibrows\DataTrans\Error\DataTransErrorHandler;
use Ibrows\DataTrans\Error\DataTransSerializeException;

interface MappingInterface
{
    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations();

    /**
     * @param  DataTransErrorHandler       $errorHandler
     * @throws DataTransSerializeException
     */
    public function validateMappingConfiguration(DataTransErrorHandler $errorHandler);

    /**
     * @return array
     */
    public function getMappedData();

    /**
     * @param  array  $data
     * @return static
     */
    public function setMappedData(array $data);
}
