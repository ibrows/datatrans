<?php

namespace Ibrows\Tests\DataTrans;

use Ibrows\DataTrans\DataInterface;

interface TestDataInterface
{
    const TEST_MERCHANTID = '1000011011';
    const TEST_AMOUNT = '1000';
    const TEST_CURRENCY = 'CHF';
    const TEST_REFNO = '91115';
    const TEST_PAYMENTMETHOD = DataInterface::PAYMENTMETHOD_VISA;
    const TEST_CARDNUMBER = '4242424242424242';
    const TEST_EXPM = '12';
    const TEST_EXPY = '15';
    const TEST_CVV = '123';
    const TEST_SIGN = '30916165706580013';

    const TEST_URL_SUCCESS = 'https://localhost/success';
    const TEST_URL_FAILED = 'https://localhost/failed';
    const TEST_URL_CANCEL = 'https://localhost/cancel';

    const TEST_RESPONSE_SUCCESS = 'https://localhost/success?uppCustomerEmail=max.muster%40maxmustermannag.ch&testOnly=yes&amount=1000&pmethod=VIS&uppCustomerFirstName=Max&uppWebResponseMethod=GET&uppCustomerCountry=CHE&uppCustomerCity=Musterort&uppCustomerZipCode=0000&refno=91115&uppCustomerDetails=yes&hiddenMode=yes&reqtype=NOA&acqAuthorizationCode=110832&uppCustomerStreet=Musterstrasse+0&responseMessage=Authorized&avsResult=*&uppTransactionId=141204110831522029&responseCode=01&expy=15&merchantId=1000011011&currency=CHF&uppCustomerLanguage=de&expm=12&uppCustomerLastName=Mustermann&authorizationCode=832302082&status=success&uppMsgType=web';
    const TEST_RESPONSE_FAILED = 'https://localhost/failed?hiddenMode=yes&merchantId=0&uppCustomerStreet=Musterstrasse+0&currency=CHF&expm=12&amount=1000&uppCustomerZipCode=0000&errorCode=1003&uppCustomerCity=Musterort&uppWebResponseMethod=GET&uppCustomerLastName=Mustermann&uppTransactionId=141204131558314439&uppCustomerCountry=CHE&errorMessage=null&uppCustomerLanguage=de&uppCustomerEmail=max.muster%40maxmustermannag.ch&uppCustomerDetails=yes&uppCustomerFirstName=Max&errorDetail=merchantId&refno=91115&expy=15&status=error&uppMsgType=web';
}
