<?php

namespace Ibrows\DataTrans\Serializer;

use Ibrows\DataTrans\Error\ErrorHandler;

class Serializer
{
    /**
     * @var ErrorHandler
     */
    protected $saferpayErrorHandler;

    /**
     * @param ErrorHandler $saferpayErrorHandler
     */
    public function __construct(ErrorHandler $saferpayErrorHandler)
    {
        $this->saferpayErrorHandler = $saferpayErrorHandler;
    }

    /**
     * @param  MappingInterface $object
     * @return array
     * @throws \Exception
     */
    public function serializeToArray(MappingInterface $object)
    {
        $object->validateMappingConfiguration($this->saferpayErrorHandler);

        return $object->getMappedData();
    }

    /**
     * @param MappingInterface $object
     * @param array            $data
     */
    public function unserializeFromArray(MappingInterface $object, array $data)
    {
        $object->validateMappingConfiguration($this->saferpayErrorHandler);
        $object->setMappedData($data);
    }
}
