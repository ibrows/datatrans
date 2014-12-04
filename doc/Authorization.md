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

### Prepare authorization request

``` {.php}
$standardAuthorizationRequest = StandardAuthorizationRequest::getInstance(
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

### Get authorization request data

``` {.php}
$authorizationRequestData = $authorization->buildAuthorizationRequestData($standardAuthorizationRequest);
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

### Handle success response

``` {.php}
$queryParams = array();
parse_str(parse_url($_SERVER['REQUEST_URI'], $queryParams);

$successAuthorizationResponse = $authorization->parseSuccessAuthorizationResponse($queryParams);
```

### Handle fail response

``` {.php}
$queryParams = array();
parse_str(parse_url($_SERVER['REQUEST_URI'], $queryParams);

$failedAuthorizationResponse = $authorization->parseFailedAuthorizationResponse($queryParams);
```

### Handle cancel response

``` {.php}
$queryParams = array();
parse_str(parse_url($_SERVER['REQUEST_URI'], $queryParams);

$cancelAuthorizationResponse = $authorization->parseCancelAuthorizationResponse($queryParams);
```