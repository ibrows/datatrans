<?php

namespace Ibrows\DataTrans\Error;

use Psr\Log\LoggerInterface;
use Saxulum\HttpClient\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class DataTransErrorHandler
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ConstraintViolationInterface[]
     */
    protected $violations = array();

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ConstraintViolationListInterface $violations
     */
    public function violations(ConstraintViolationListInterface $violations)
    {
        foreach ($violations as $violation) {
            $this->violation($violation);
        }
    }

    /**
     * @param ConstraintViolationInterface $violation
     */
    public function violation(ConstraintViolationInterface $violation)
    {
        $this->violations[] = $violation;

        $this->logger->warning("DataTrans: validation warning, '{class}', '{property}', '{message}', '{invalidValue}'!", array(
            'content' => get_class($violation->getRoot()),
            'property' => $violation->getPropertyPath(),
            'message' => $violation->getMessage(),
            'invalidValue' => is_scalar($violation->getInvalidValue()) ? $violation->getInvalidValue() : '_object_'
        ));
    }

    /**
     * @return ConstraintViolationInterface[]
     */
    public function getAndCleanViolations()
    {
        $violations = $this->violations;
        $this->violations = array();

        return $violations;
    }

    /**
     * @param $class
     * @param $propertyName
     * @throws DataTransSerializeException
     */
    public function mappingNotFoundPropertyName($class, $propertyName)
    {
        $this->logger->critical(
            "DataTrans: there is no property with name '{propertyName}' on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        );

        throw new DataTransSerializeException($this->prepareExceptionMessage(
            "DataTrans: there is no property with name '{propertyName}' on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        ));
    }

    /**
     * @param $class
     * @param $propertyName
     * @throws DataTransSerializeException
     */
    public function mappingDuplicatePropertyName($class, $propertyName)
    {
        $this->logger->critical(
            "DataTrans: duplicate property with name '{propertyName}' within configuration on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        );

        throw new DataTransSerializeException($this->prepareExceptionMessage(
            "DataTrans: duplicate property with name '{propertyName}' within configuration on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        ));
    }

    /**
     * @param $class
     * @param $serializeName
     * @throws DataTransSerializeException
     */
    public function mappingDuplicateSerializedName($class, $serializeName)
    {
        $this->logger->critical(
            "DataTrans: duplicate serialize name with name '{serializeName}' within configuration on class {class}!", array(
                'serializeName' => $serializeName,
                'class' => $class
            )
        );

        throw new DataTransSerializeException($this->prepareExceptionMessage(
            "DataTrans: duplicate serialize name with name '{serializeName}' within configuration on class {class}!", array(
                'serializeName' => $serializeName,
                'class' => $class
            )
        ));
    }

    /**
     * @param $xml
     * @throws DataTransXMLParseException
     */
    public function xmlParse($xml)
    {
        $this->logger->critical("DataTrans: xml '{xml}' is not parseable!", array(
            'xml' => $xml
        ));

        throw new DataTransXMLParseException($this->prepareExceptionMessage(
            "DataTrans: xml '{xml}' is not parseable!", array(
                'xml' => $xml
            )
        ));
    }

    /**
     * @param  Response                  $response
     * @throws DataTransResponseException
     */
    public function response(Response $response)
    {
        $this->logger->critical('DataTrans: request failed: {content}!', array('content' => $response->getContent()));

        throw new DataTransResponseException($this->prepareExceptionMessage(
            'DataTrans: request failed: {content}!', array('content' => $response->getContent())
        ));
    }

    /**
     * @param  string                  $expect
     * @param  string                  $actual
     * @throws DataTransResultException
     */
    public function result($expect, $actual)
    {
        $this->logger->critical('DataTrans: result not 0: {result}!', array('expect' => $expect, 'actual' => $actual));

        throw new DataTransResultException($this->prepareExceptionMessage(
            'DataTrans: result not 0: {result}!', array('expect' => $expect, 'actual' => $actual)
        ));
    }

    /**
     * @param        $message
     * @param  array $context
     * @return mixed
     */
    protected function prepareExceptionMessage($message, array $context = array())
    {
        foreach ($context as $contextKey => $contextValue) {
            $message = str_replace('{' . $contextKey . '}', $contextValue, $message);
        }

        return $message;
    }
}
