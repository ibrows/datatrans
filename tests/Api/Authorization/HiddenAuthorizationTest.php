<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequest;
use Ibrows\DataTrans\Constants;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\Tests\DataTrans\DataTransProvider;
use Pimple\Container;
use Saxulum\HttpClient\History;

class CreditCardTest extends \PHPUnit_Framework_TestCase
{
    public function testPayWithCreditCard()
    {
        $container = new Container();
        $container->register(new DataTransProvider());

        /** @var Authorization $dataTransAuthorization */
        $dataTransAuthorization = $container['datatrans_authorization'];

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $container['datatrans_error_handler'];

        $later = new \DateTime('+6 months');

        $orderId = \Dominikzogg\ClassHelpers\objectId();

        $history = new History();

        try {
            $dataTransAuthorization->authorizationRequest(HiddenAuthorizationRequest::getInstance(
                Constants::TEST_MERCHANTID,
                Constants::TEST_AMOUNT,
                Constants::TEST_CURRENCY
            ), $history);

            $this->assertCount(0, $errorHandler->getAndCleanViolations());
        } catch (\Exception $e) {
            print (string) $history;
            throw $e;
        }
    }
}
