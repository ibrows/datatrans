<?php

namespace Ibrows\Tests\DataTrans\Error;

use Ibrows\DataTrans\Error\ErrorHandler;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Constraints\Null;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class ErrorHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected $test;

    public function testViolation()
    {
        $errorHandler = $this->getErrorHandler();

        $violation = $this->createViolation('test');

        $errorHandler->violation($violation);
    }

    public function testViolations()
    {
        $errorHandler = $this->getErrorHandler();

        $violations = new ConstraintViolationList();
        $violations->add($this->createViolation('test'));

        $errorHandler->violations($violations);
    }

    public function testMappingNotFoundPropertyName()
    {
        $errorHandler = $this->getErrorHandler();

        $this->setExpectedException(
            'Ibrows\DataTrans\Error\SerializeException',
            "DataTrans: there is no property with name 'test' on class 'Ibrows\\Tests\\DataTrans\\Error\\ErrorHandlerTest'!"
        );

        $errorHandler->mappingNotFoundPropertyName(__CLASS__, 'test');
    }

    public function testMappingDuplicatePropertyName()
    {
        $errorHandler = $this->getErrorHandler();

        $this->setExpectedException(
            'Ibrows\DataTrans\Error\SerializeException',
            "DataTrans: duplicate property with name 'test' within configuration on class 'Ibrows\\Tests\\DataTrans\\Error\\ErrorHandlerTest'!"
        );

        $errorHandler->mappingDuplicatePropertyName(__CLASS__, 'test');
    }

    public function testMappingDuplicateSerializedName()
    {
        $errorHandler = $this->getErrorHandler();

        $this->setExpectedException(
            'Ibrows\DataTrans\Error\SerializeException',
            "DataTrans: duplicate serialize name with name 'test' within configuration on class 'Ibrows\\Tests\\DataTrans\\Error\\ErrorHandlerTest'!"
        );

        $errorHandler->mappingDuplicateSerializedName(__CLASS__, 'test');
    }

    protected function getErrorHandler()
    {
        return new ErrorHandler(new NullLogger());
    }

    /**
     * @param string $message
     * @param array $parameters
     * @param string $propertyPath
     * @param string $invalidValue
     * @param int|null $plural
     * @param mixed $code
     * @return ConstraintViolation
     */
    protected function createViolation($message, array $parameters = array(), $propertyPath = 'property.path', $invalidValue = 'InvalidValue', $plural = null, $code = null)
    {
        return new ConstraintViolation(
            null,
            $message,
            $parameters,
            new \stdClass(),
            $propertyPath,
            $invalidValue,
            $plural,
            $code,
            new Null()
        );
    }
}
