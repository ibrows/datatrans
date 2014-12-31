<?php

namespace Ibrows\Tests\DataTrans;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Client\FileGetContents;
use Ibrows\DataTrans\Api\Authorization\Authorization;
use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Serializer\Serializer;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Saxulum\HttpClient\Buzz\HttpClient;
use Symfony\Component\Validator\Validation;

class DataTransProvider implements ServiceProviderInterface
{
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['datatrans_validator'] = function () use ($pimple) {
             return Validation::createValidatorBuilder()
                 ->addMethodMapping('loadValidatorMetadata')
                 ->getValidator()
             ;
        };

        $pimple['datatrans_error_handler'] = function () use ($pimple) {
            return new ErrorHandler($pimple['datatrans_logger']);
        };

        $pimple['datatrans_serializer'] = function () use ($pimple) {
            return new Serializer($pimple['datatrans_error_handler']);
        };

        $pimple['datatrans_logger'] = function () use ($pimple) {
            return new Logger();
        };

        $pimple['datatrans_httpclient'] = function () {
            $client = new Curl();
            return new HttpClient(new Browser($client));

        };

        $pimple['datatrans_authorization'] = function () use ($pimple) {
            return new Authorization(
                $pimple['datatrans_validator'],
                $pimple['datatrans_error_handler'],
                $pimple['datatrans_serializer']
            );
        };
    }
}
