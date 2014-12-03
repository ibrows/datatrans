<?php

namespace Ibrows\DataTrans\Error;

use Psr\Log\LoggerInterface;
use Saxulum\HttpClient\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ErrorHandler
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
     * @throws SerializeException
     */
    public function mappingNotFoundPropertyName($class, $propertyName)
    {
        $this->logger->critical(
            "DataTrans: there is no property with name '{propertyName}' on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        );

        throw new SerializeException($this->prepareExceptionMessage(
            "DataTrans: there is no property with name '{propertyName}' on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        ));
    }

    /**
     * @param $class
     * @param $propertyName
     * @throws SerializeException
     */
    public function mappingDuplicatePropertyName($class, $propertyName)
    {
        $this->logger->critical(
            "DataTrans: duplicate property with name '{propertyName}' within configuration on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        );

        throw new SerializeException($this->prepareExceptionMessage(
            "DataTrans: duplicate property with name '{propertyName}' within configuration on class {class}!", array(
                'propertyName' => $propertyName,
                'class' => $class
            )
        ));
    }

    /**
     * @param $class
     * @param $serializeName
     * @throws SerializeException
     */
    public function mappingDuplicateSerializedName($class, $serializeName)
    {
        $this->logger->critical(
            "DataTrans: duplicate serialize name with name '{serializeName}' within configuration on class {class}!", array(
                'serializeName' => $serializeName,
                'class' => $class
            )
        );

        throw new SerializeException($this->prepareExceptionMessage(
            "DataTrans: duplicate serialize name with name '{serializeName}' within configuration on class {class}!", array(
                'serializeName' => $serializeName,
                'class' => $class
            )
        ));
    }

    /**
     * @param $xml
     * @throws XMLParseException
     */
    public function xmlParse($xml)
    {
        $this->logger->critical("DataTrans: xml '{xml}' is not parseable!", array(
            'xml' => $xml
        ));

        throw new XMLParseException($this->prepareExceptionMessage(
            "DataTrans: xml '{xml}' is not parseable!", array(
                'xml' => $xml
            )
        ));
    }

    /**
     * @param  Response                  $response
     * @throws ResponseException
     */
    public function response(Response $response)
    {
        $this->logger->critical('DataTrans: request failed: {content}!', array('content' => $response->getContent()));

        throw new ResponseException($this->prepareExceptionMessage(
            'DataTrans: request failed: {content}!', array('content' => $response->getContent())
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