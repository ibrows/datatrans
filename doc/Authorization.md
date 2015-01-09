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
$standardAuthorizationRequest = StandardAuthorizationRequest::createValidInstance(
    TestDataInterface::MERCHANTID,
    TestDataInterface::AMOUNT,
    TestDataInterface::CURRENCY,
    TestDataInterface::REFNO,
    TestDataInterface::URL_SUCCESS,
    TestDataInterface::URL_FAILED,
    TestDataInterface::URL_CANCEL
);

$standardAuthorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
$standardAuthorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
$standardAuthorizationRequest->setUppCustomerFirstName(TestDataInterface::CUSTOMER_FIRSTNAME);
$standardAuthorizationRequest->setUppCustomerLastName(TestDataInterface::CUSTOMER_LASTNAME);
$standardAuthorizationRequest->setUppCustomerStreet(TestDataInterface::CUSTOMER_STREET);
$standardAuthorizationRequest->setUppCustomerCity(TestDataInterface::CUSTOMER_CITY);
$standardAuthorizationRequest->setUppCustomerZipCode(TestDataInterface::CUSTOMER_ZIPCODE);
$standardAuthorizationRequest->setUppCustomerCountry(TestDataInterface::CUSTOMER_COUNTRY);
$standardAuthorizationRequest->setUppCustomerEmail(TestDataInterface::CUSTOMER_EMAIL);
$standardAuthorizationRequest->setUppCustomerLanguage(TestDataInterface::CUSTOMER_LANGUAGE);
```

### Validate authorization request (not in SimpleAuthorization)

``` {.php}
$violations = $authorization->validateAuthorizationRequest($standardAuthorizationRequest);
```

### Get authorization request data

``` {.php}
$authorizationRequestData = $authorization->serializeAuthorizationRequest($standardAuthorizationRequest);
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

$standardAuthorizationResponse = $authorization->unserializeAuthorizationResponse($status, $queryParams);
```

### Handle success response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$standardAuthorizationResponse = $authorization->unserializeSuccessAuthorizationResponse($queryParams);
```

### Handle fail response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$standardAuthorizationResponse = $authorization->unserializeFailedAuthorizationResponse($queryParams);
```

### Handle cancel response

``` {.php}
$queryParams = array();
unserialize_str(unserialize_url($_SERVER['REQUEST_URI'], $queryParams);

$standardAuthorizationResponse = $authorization->unserializeCancelAuthorizationResponse($queryParams);
```

### Validate authorization response (not in SimpleAuthorization)

``` {.php}
$violations = $authorization->validateAuthorizationResponse($standardAuthorizationResponse);
```