<?php

namespace Ibrows\DataTrans\Serializer;

use Ibrows\DataTrans\Error\ErrorHandler;

class Serializer
{
    /**
     * @var ErrorHandler
     */
    protected $errorHandler;

    /**
     * @param ErrorHandler $errorHandler
     */
    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    /**
     * @param  MappingInterface $object
     * @return array
     * @throws \Exception
     */
    public function serializeToArray(MappingInterface $object)
    {
        $object->validateMappingConfiguration($this->errorHandler);

        return $object->getMappedData();
    }

    /**
     * @param MappingInterface $object
     * @param array            $data
     */
    public function unserializeFromArray(MappingInterface $object, array $data)
    {
        $object->validateMappingConfiguration($this->errorHandler);
        $object->setMappedData($data);
    }
}
