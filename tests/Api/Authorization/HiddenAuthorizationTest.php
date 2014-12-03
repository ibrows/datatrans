<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequest;
use Ibrows\DataTrans\Constants;
use Ibrows\DataTrans\Error\DataTransErrorHandler;
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

        /** @var DataTransErrorHandler $dataTransErrorHandler */
        $dataTransErrorHandler = $container['datatrans_error_handler'];

        $later = new \DateTime('+6 months');

        $orderId = \Dominikzogg\ClassHelpers\objectId();

        $history = new History();

        try {
            $dataTransAuthorization->authorizationRequest(HiddenAuthorizationRequest::getInstance(
                Constants::TEST_PASSWORD,
                Constants::TEST_ACCOUNT,
                Constants::TEST_CARD,
                $later->format('my'),
                Constants::TEST_CVC,
                Constants::TEST_AMOUNT,
                Constants::TEST_CURRENCY,
                $orderId
            ), $history);

            $this->assertCount(0, $dataTransErrorHandler->getAndCleanViolations());
        } catch (\Exception $e) {
            print (string) $history;
            throw $e;
        }
    }
}
