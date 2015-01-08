<?php

namespace Ibrows\Tests\DataTrans;

use Ibrows\DataTrans\DataInterface;

interface TestDataInterface
{
    const MERCHANTID = '1000011011';
    const AMOUNT = '1000';
    const CURRENCY = 'CHF';
    const REFNO = '91115';
    const PAYMENTMETHOD = DataInterface::PAYMENTMETHOD_VISA;
    const CARDNUMBER = '4242424242424242';
    const EXPM = '12';
    const EXPY = '15';
    const CVV = '123';
    const SIGN = '30916165706580013';
    const ALIASCC = 'alias1';
    const CUSTOMER_FIRSTNAME = 'Max';
    const CUSTOMER_LASTNAME = 'Mustermann';
    const CUSTOMER_STREET = 'Musterstrasse 0';
    const CUSTOMER_CITY = 'Musterort';
    const CUSTOMER_ZIPCODE = '0000';
    const CUSTOMER_COUNTRY = 'CHE';
    const CUSTOMER_EMAIL = 'max.muster@maxmustermannag.ch';
    const CUSTOMER_LANGUAGE = 'de';

    const URL_SUCCESS = 'https://localhost/success';
    const URL_FAILED = 'https://localhost/failed';
    const URL_CANCEL = 'https://localhost/cancel';

    const RESPONSE_SUCCESS = 'https://localhost/success?uppCustomerEmail=max.muster%40maxmustermannag.ch&testOnly=yes&amount=1000&pmethod=VIS&uppCustomerFirstName=Max&uppWebResponseMethod=GET&uppCustomerCountry=CHE&uppCustomerCity=Musterort&uppCustomerZipCode=0000&refno=91115&uppCustomerDetails=yes&hiddenMode=yes&reqtype=NOA&acqAuthorizationCode=110832&uppCustomerStreet=Musterstrasse+0&responseMessage=Authorized&avsResult=*&uppTransactionId=141204110831522029&responseCode=01&expy=15&merchantId=1000011011&currency=CHF&uppCustomerLanguage=de&expm=12&uppCustomerLastName=Mustermann&authorizationCode=832302082&status=success&uppMsgType=web';
    const RESPONSE_FAILED = 'https://localhost/failed?hiddenMode=yes&merchantId=0&uppCustomerStreet=Musterstrasse+0&currency=CHF&expm=12&amount=1000&uppCustomerZipCode=0000&errorCode=1003&uppCustomerCity=Musterort&uppWebResponseMethod=GET&uppCustomerLastName=Mustermann&uppTransactionId=141204131558314439&uppCustomerCountry=CHE&errorMessage=null&uppCustomerLanguage=de&uppCustomerEmail=max.muster%40maxmustermannag.ch&uppCustomerDetails=yes&uppCustomerFirstName=Max&errorDetail=merchantId&refno=91115&expy=15&status=error&uppMsgType=web';
}
