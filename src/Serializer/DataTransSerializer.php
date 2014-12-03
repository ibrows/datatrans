<?php

namespace Ibrows\DataTrans\Serializer;

use Ibrows\DataTrans\Error\DataTransErrorHandler;

class DataTransSerializer
{
    /**
     * @var DataTransErrorHandler
     */
    protected $saferpayErrorHandler;

    /**
     * @param DataTransErrorHandler $saferpayErrorHandler
     */
    public function __construct(DataTransErrorHandler $saferpayErrorHandler)
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
}
