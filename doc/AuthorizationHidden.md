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

### Prepare authorization request

``` {.php}
$hiddenAuthorizationRequest = HiddenAuthorizationRequest::getInstance(
    TestDataInterface::MERCHANTID,
    TestDataInterface::AMOUNT,
    TestDataInterface::CURRENCY,
    TestDataInterface::REFNO,
    TestDataInterface::URL_SUCCESS,
    TestDataInterface::URL_FAILED,
    TestDataInterface::URL_CANCEL
);

$hiddenAuthorizationRequest->setPaymentMethod(TestDataInterface::PAYMENTMETHOD);
$hiddenAuthorizationRequest->setCardNo(TestDataInterface::CARDNUMBER);
$hiddenAuthorizationRequest->setExpm(TestDataInterface::EXPM);
$hiddenAuthorizationRequest->setExpy(TestDataInterface::EXPY);
$hiddenAuthorizationRequest->setCvv(TestDataInterface::CVV);

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

### Get authorization request data

``` {.php}
$authorizationRequestData = $authorization->buildAuthorizationRequestData($hiddenAuthorizationRequest);
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

$successAuthorizationResponse = $dataTransAuthorization->parseSuccessAuthorizationResponse($queryParams);
```

### Handle fail response

``` {.php}
$queryParams = array();
parse_str(parse_url($_SERVER['REQUEST_URI'], $queryParams);

$failedAuthorizationResponse = $dataTransAuthorization->parseFailedAuthorizationResponse($queryParams);
```

### Handle cancel response

``` {.php}
$queryParams = array();
parse_str(parse_url($_SERVER['REQUEST_URI'], $queryParams);

$cancelAuthorizationResponse = $dataTransAuthorization->parseCancelAuthorizationResponse($queryParams);
```