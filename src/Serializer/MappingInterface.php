<?php

namespace Ibrows\DataTrans\Serializer;

use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Error\SerializeException;

interface MappingInterface
{
    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations();

    /**
     * @param  ErrorHandler       $errorHandler
     * @throws SerializeException
     */
    public function validateMappingConfiguration(ErrorHandler $errorHandler);

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
