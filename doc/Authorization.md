# Authorization

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

``` {.php}
$suthorizationRequest = $authorization->createStandardAuthorizationRequest(
    TestDataInterface::MERCHANTID,
    TestDataInterface::AMOUNT,
    TestDataInterface::CURRENCY,
    TestDataInterface::REFNO,
    TestDataInterface::URL_SUCCESS,
    TestDataInterface::URL_FAILED,
    TestDataInterface::URL_CANCEL
);

$suthorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
$suthorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
$suthorizationRequest->setUppCustomerFirstName(TestDataInterface::CUSTOMER_FIRSTNAME);
$suthorizationRequest->setUppCustomerLastName(TestDataInterface::CUSTOMER_LASTNAME);
$suthorizationRequest->setUppCustomerStreet(TestDataInterface::CUSTOMER_STREET);
$suthorizationRequest->setUppCustomerCity(TestDataInterface::CUSTOMER_CITY);
$suthorizationRequest->setUppCustomerZipCode(TestDataInterface::CUSTOMER_ZIPCODE);
$suthorizationRequest->setUppCustomerCountry(TestDataInterface::CUSTOMER_COUNTRY);
$suthorizationRequest->setUppCustomerEmail(TestDataInterface::CUSTOMER_EMAIL);
$suthorizationRequest->setUppCustomerLanguage(TestDataInterface::CUSTOMER_LANGUAGE);
```

### Validate authorization request (not in SimpleAuthorization)

``` {.php}
$violations = $authorization->validateAuthorizationRequest($suthorizationRequest);
```

### Get authorization request data

``` {.php}
$authorizationRequestData = $authorization->serializeAuthorizationRequest($suthorizationRequest);
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