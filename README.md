# ibrows/datatrans

## Installation

### Prepare Services

``` {.php}
<?php

use Ibrows\DataTrans\Error\ErrorHandler;
use Ibrows\DataTrans\Validator\DataTransValidator;
use Psr\Log\NullLogger;

$errorHandler = new ErrorHandler(new Logger());
$serializer = new Serializer($errorHandler);
$validator = Validation::createValidatorBuilder()
  ->addMethodMapping('loadValidatorMetadata')
  ->getValidator()
;
```

## Usage

 * [AuthorizationHidden][1]

[1]: https://ibrows.codebasehq.com/projects/ibrowsch/repositories/datatrans/blob/master/doc/AuthorizationHidden.md