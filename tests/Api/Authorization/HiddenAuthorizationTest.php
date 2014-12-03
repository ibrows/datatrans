<?php

namespace Ibrows\Tests\DataTrans\Api\Authorization;

use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Api\Authorization\Data\Request\HiddenAuthorizationRequest;
use Ibrows\DataTrans\Constants;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\Tests\DataTrans\DataTransProvider;
use Pimple\Container;
use Saxulum\HttpClient\History;

class HiddenAuthorizationTest extends \PHPUnit_Framework_TestCase
{
    public function testAuthorization()
    {
        $container = new Container();
        $container->register(new DataTransProvider());

        /** @var Authorization $dataTransAuthorization */
        $dataTransAuthorization = $container['datatrans_authorization'];

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $container['datatrans_error_handler'];

        $history = new History();

        try {
            $dataTransAuthorization->authorizationRequest(HiddenAuthorizationRequest::getInstance(
                Constants::TEST_MERCHANTID,
                Constants::TEST_AMOUNT,
                Constants::TEST_CURRENCY,
                Constants::TEST_REFNO,
                null,
                'https://localhost/success',
                'https://localhost/error',
                'https://localhost/cancel',
                Constants::TEST_PAYMENTMETHOD,
                Constants::TEST_CARDNUMBER,
                null,
                Constants::TEST_EXPM,
                Constants::TEST_EXPY,
                Constants::TEST_CVV
            ), $history);

            $this->assertCount(0, $errorHandler->getAndCleanViolations());

            print (string) $history;
        } catch (\Exception $e) {
            print (string) $history;
            throw $e;
        }
    }
}
