# Authorization Hidden

## Usage

### Prepare api

``` {.php}
$authorization = new Authorization(
    $errorHandler
    $serializer,
    $validator
);
```

### If you want to use the simple authorization (automatic validation)

``` {.php}
$authorization = new SimpleAuthorization($authorization);
```

### Prepare authorization request

#### With cardnumber

``` {.php}
$authorizationRequest = $authorization->createHiddenAuthorizationRequestWithCardNo(
    TestDataInterface::MERCHANTID,
    TestDataInterface::AMOUNT,
    TestDataInterface::CURRENCY,
    TestDataInterface::REFNO,
    TestDataInterface::URL_SUCCESS,
    TestDataInterface::URL_FAILED,
    TestDataInterface::URL_CANCEL,
    TestDataInterface::PAYMENTMETHOD
    TestDataInterface::CARDNUMBER
    TestDataInterface::EXPM
    TestDataInterface::EXPY
    TestDataInterface::CVV
);
```

#### With aliascc

``` {.php}
$authorizationRequest = $authorization->createHiddenAuthorizationRequestWithAliasCC(
    TestDataInterface::MERCHANTID,
    TestDataInterface::AMOUNT,
    TestDataInterface::CURRENCY,
    TestDataInterface::REFNO,
    TestDataInterface::URL_SUCCESS,
    TestDataInterface::URL_FAILED,
    TestDataInterface::URL_CANCEL,
    'aliasCC'
);
```

``` {.php}
$authorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
$authorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
$authorizationRequest->setUppCustomerFirstName(TestDataInterface::CUSTOMER_FIRSTNAME);
$authorizationRequest->setUppCustomerLastName(TestDataInterface::CUSTOMER_LASTNAME);
$authorizationRequest->setUppCustomerStreet(TestDataInterface::CUSTOMER_STREET);
$authorizationRequest->setUppCustomerCity(TestDataInterface::CUSTOMER_CITY);
$authorizationRequest->setUppCustomerZipCode(TestDataInterface::CUSTOMER_ZIPCODE);
$authorizationRequest->setUppCustomerCountry(TestDataInterface::CUSTOMER_COUNTRY);
$authorizationRequest->setUppCustomerEmail(TestDataInterface::CUSTOMER_EMAIL);
$authorizationRequest->setUppCustomerLanguage(TestDataInterface::CUSTOMER_LANGUAGE);
```

### Validate authorization request (not in SimpleAuthorization)

``` {.php}
$violations = $authorization->validateAuthorizationRequest($authorizationRequest);
```

### Get authorization request data

``` {.php}
$authorizationRequestData = $authorization->serializeAuthorizationRequest($authorizationRequest);
```

### Build url

``` {.php}
$url = DataInterface::URL_AUTHORIZATION . '?' . http_build_query($authorizationRequestData);
```

### Redirect to url

``` {.php}
header('Location: ' . $url);
die();
```

### Handle response (choose this or the concrete methods)

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$authorizationResponse = $authorization->unserializeAuthorizationResponse($status, $queryParams);
```

### Handle success response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$authorizationResponse = $authorization->unserializeSuccessAuthorizationResponse($queryParams);
```

### Handle fail response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$authorizationResponse = $authorization->unserializeFailedAuthorizationResponse($queryParams);
```

### Handle cancel response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$authorizationResponse = $authorization->unserializeCancelAuthorizationResponse($queryParams);
```

### Validate authorization response (not in SimpleAuthorization)

``` {.php}
$violations = $authorization->validateAuthorizationResponse($authorizationResponse);
```