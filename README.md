# ibrows/datatrans

[![Build Status](https://api.travis-ci.org/ibrows/datatrans.png?branch=master)](https://travis-ci.org/ibrows/datatrans)
[![Total Downloads](https://poser.pugx.org/ibrows/datatrans/downloads.png)](https://packagist.org/packages/ibrows/datatrans)
[![Latest Stable Version](https://poser.pugx.org/ibrows/datatrans/v/stable.png)](https://packagist.org/packages/ibrows/datatrans)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ibrows/datatrans/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ibrows/datatrans/?branch=master)

## Installation

### Prepare Services

``` {.php}
<?php

use Ibrows\DataTrans\Error\ErrorHandler;
use Psr\Log\NullLogger;
use Symfony\Component\Validator\Validation;

$errorHandler = new ErrorHandler(new Logger());
$serializer = new Serializer($errorHandler);
$validator = Validation::createValidatorBuilder()
  ->addMethodMapping('loadValidatorMetadata')
  ->getValidator()
;
```

## Usage

 * [Authorization][1]
 * [AuthorizationHidden][2]

[1]: https://github.com/ibrows/datatrans/blob/master/doc/Authorization.md
[2]: https://github.com/ibrows/datatrans/blob/master/doc/AuthorizationHidden.md
