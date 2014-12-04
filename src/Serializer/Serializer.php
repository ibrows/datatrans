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
     * @return string
     * @throws \Exception
     */
    public function serializeToQuery(MappingInterface $object)
    {
        $object->validateMappingConfiguration($this->saferpayErrorHandler);
        $data = $object->getMappedData();

        return http_build_query($data);
    }

    /**
     * @param MappingInterface $object
     * @param array            $data
     */
    public function unserializeArray(MappingInterface $object, array $data)
    {
        $object->validateMappingConfiguration($this->saferpayErrorHandler);
        $object->setMappedData($data);
    }
}
