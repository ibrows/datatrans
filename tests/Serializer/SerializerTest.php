<?php

namespace Ibrows\Tests\DataTrans\Serializer;

use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Error\SerializeException;
use Ibrows\DataTrans\Serializer\AbstractData;
use Ibrows\DataTrans\Serializer\MappingConfiguration;
use Ibrows\DataTrans\Serializer\Serializer;
use Psr\Log\NullLogger;

class SerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testSerializeToArray()
    {
        $serializer = $this->getSerializer();

        $object = new TestData();
        $object->setTest('hello');

        $array = $serializer->serializeToArray($object);

        $this->assertArrayHasKey('test', $array);
        $this->assertEquals('hello', $array['test']);
    }

    public function testUnserializeToArray()
    {
        $serializer = $this->getSerializer();

        $object = new TestData();
        $array = array('test' => 'hello');

        $serializer->unserializeFromArray($object, $array);

        $this->assertEquals('hello', $object->getTest());
    }

    protected function getSerializer()
    {
        return new Serializer(new ErrorHandler(new NullLogger()));
    }
}

class TestData extends AbstractData
{
    /**
     * @var string
     */
    protected $test;

    /**
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param string $test
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return MappingConfiguration[]
     */
    public function getMappingConfigurations()
    {
        return array(
            new MappingConfiguration('test', 'test')
        );
    }
}
