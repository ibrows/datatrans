# ibrows/datatrans

## Installation

### Add some helper functions

``` {.php}
function requestUrl()
{
    $protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, strpos($_SERVER['SERVER_PROTOCOL'], '/')));
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function getParam($key, $default = null)
{
    return array_key_exists($key, $_REQUEST) ? $_REQUEST[$key] : $default;
}
```

### Prepare Services

``` {.php}
<?php

use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\RequestHandler;
use Ibrows\DataTrans\Validator\DataTransValidator;
use Psr\Log\NullLogger;
use Saxulum\HttpClient\Buzz\HttpClient;

$ErrorHandler = new ErrorHandler(new Logger());
$Serializer = new Serializer($ErrorHandler);
$RequestHandler = new RequestHandler(new HttpClient(), $ErrorHandler);
$validator = Validation::createValidatorBuilder()
  ->addMethodMapping('loadValidatorMetadata')
  ->getValidator()
;
```

## Usage

 * [AddSecureCard][1]

[1]: https://ibrows.codebasehq.com/projects/ibrowsch/repositories/datatrans/blob/master/doc/AddSecureCard.md