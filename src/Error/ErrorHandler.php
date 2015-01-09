<?php

namespace Ibrows\DataTrans\Error;

use Psr\Log\LoggerInterface;
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
     * @param $class
     * @param $propertyName
     * @throws SerializeException
     */
    public function mappingNotFoundPropertyName($class, $propertyName)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

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
        if (is_object($class)) {
            $class = get_class($class);
        }

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
        if (is_object($class)) {
            $class = get_class($class);
        }

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
