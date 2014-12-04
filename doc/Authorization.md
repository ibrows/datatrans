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
$hiddenAuthorizationRequest = StandardAuthorizationRequest::getInstance(
    TestDataInterface::TEST_MERCHANTID,
    TestDataInterface::TEST_AMOUNT,
    TestDataInterface::TEST_CURRENCY,
    TestDataInterface::TEST_REFNO,
    TestDataInterface::TEST_URL_SUCCESS,
    TestDataInterface::TEST_URL_FAILED,
    TestDataInterface::TEST_URL_CANCEL
);

$hiddenAuthorizationRequest->setUppWebResponseMethod(DataInterface::RESPONSEMETHOD_GET);
$hiddenAuthorizationRequest->setUppCustomerDetails(DataInterface::CUSTOMERDETAIL_TRUE);
$hiddenAuthorizationRequest->setUppCustomerFirstName(TestDataInterface::TEST_CUSTOMER_FIRSTNAME);
$hiddenAuthorizationRequest->setUppCustomerLastName(TestDataInterface::TEST_CUSTOMER_LASTNAME);
$hiddenAuthorizationRequest->setUppCustomerStreet(TestDataInterface::TEST_CUSTOMER_STREET);
$hiddenAuthorizationRequest->setUppCustomerCity(TestDataInterface::TEST_CUSTOMER_CITY);
$hiddenAuthorizationRequest->setUppCustomerZipCode(TestDataInterface::TEST_CUSTOMER_ZIPCODE);
$hiddenAuthorizationRequest->setUppCustomerCountry(TestDataInterface::TEST_CUSTOMER_COUNTRY);
$hiddenAuthorizationRequest->setUppCustomerEmail(TestDataInterface::TEST_CUSTOMER_EMAIL);
$hiddenAuthorizationRequest->setUppCustomerLanguage(TestDataInterface::TEST_CUSTOMER_LANGUAGE);
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