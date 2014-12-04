# ibrows/datatrans

## Installation

### Prepare Services

``` {.php}
<?php

use Ibrows\DataTrans\Error\ErrorHandler;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Validation;

$logger = new Logger();
$errorHandler = new ErrorHandler($logger);
$serializer = new Serializer($errorHandler);
$validator = Validation::createValidatorBuilder()
  ->addMethodMapping('loadValidatorMetadata')
  ->getValidator()
;
```

## Usage

 * [Authorization][1]
 * [AuthorizationHidden][2]

[1]: https://ibrows.codebasehq.com/projects/ibrowsch/repositories/datatrans/blob/master/doc/Authorization.md
[2]: https://ibrows.codebasehq.com/projects/ibrowsch/repositories/datatrans/blob/master/doc/AuthorizationHidden.md