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
$hiddenAuthorizationRequest = HiddenAuthorizationRequestWithCardNo::createValidInstance(
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
$hiddenAuthorizationRequest = HiddenAuthorizationRequestWithAliasCC::createValidInstance(
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
$hiddenAuthorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
$hiddenAuthorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
$hiddenAuthorizationRequest->setUppCustomerFirstName(TestDataInterface::CUSTOMER_FIRSTNAME);
$hiddenAuthorizationRequest->setUppCustomerLastName(TestDataInterface::CUSTOMER_LASTNAME);
$hiddenAuthorizationRequest->setUppCustomerStreet(TestDataInterface::CUSTOMER_STREET);
$hiddenAuthorizationRequest->setUppCustomerCity(TestDataInterface::CUSTOMER_CITY);
$hiddenAuthorizationRequest->setUppCustomerZipCode(TestDataInterface::CUSTOMER_ZIPCODE);
$hiddenAuthorizationRequest->setUppCustomerCountry(TestDataInterface::CUSTOMER_COUNTRY);
$hiddenAuthorizationRequest->setUppCustomerEmail(TestDataInterface::CUSTOMER_EMAIL);
$hiddenAuthorizationRequest->setUppCustomerLanguage(TestDataInterface::CUSTOMER_LANGUAGE);
```

### Validate authorization request (not in SimpleAuthorization)

``` {.php}
$violations = $authorization->validateAuthorizationRequest($hiddenAuthorizationRequest);
```

### Get authorization request data

``` {.php}
$authorizationRequestData = $authorization->serializeAuthorizationRequest($hiddenAuthorizationRequest);
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

$hiddenAuthorizationResponse = $authorization->unserializeAuthorizationResponse($status, $queryParams);
```

### Handle success response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$hiddenAuthorizationResponse = $authorization->unserializeSuccessAuthorizationResponse($queryParams);
```

### Handle fail response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$hiddenAuthorizationResponse = $authorization->unserializeFailedAuthorizationResponse($queryParams);
```

### Handle cancel response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$hiddenAuthorizationResponse = $authorization->unserializeCancelAuthorizationResponse($queryParams);
```

### Validate authorization response (not in SimpleAuthorization)

``` {.php}
$violations = $authorization->validateAuthorizationResponse($hiddenAuthorizationResponse);
```