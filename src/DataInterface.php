<?php

namespace Ibrows\DataTrans;

interface DataInterface
{
    const version = '8.41';

    const URL_AUTHORIZATION = 'https://pay.datatrans.com/upp/jsp/upStart.jsp';
    const URL_XMLSETTLEMENT = 'https://api.datatrans.com/upp/jsp/XML_processor.jsp';

    const RESPONSESTATUS_SUCCESS = 'success';
    const RESPONSESTATUS_FAILED = 'error';
    const RESPONSESTATUS_CANCEL = 'cancel';

    const MSGTYPE_GET = 'web';
    const MSGTYPE_POST = 'post';

    const BOOL_TRUE = 'yes';
    const BOOL_FALSE = 'no';
    const BOOL_AUTO = 'auto';

    const REQTYPE_AUTHORIZATIONONLY = 'NOA';
    const REQTYPE_AUTHORIZATIONWITHIMMEDIATESETTLEMENT = 'CAA';

    const RESPONSEMETHOD_GET = 'GET';
    const RESPONSEMETHOD_POST = 'POST';

    const STATUS_ENABLED = 'on';
    const STATUS_DISABLED = 'off';

    const CUSTOMERDETAIL_TRUE = 'yes';
    const CUSTOMERDETAIL_FALSE = 'no';
    const CUSTOMERDETAIL_RETURN = 'return';

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    const PAYMENTMETHOD_VISA = 'VIS';
    const PAYMENTMETHOD_MASTERCARD = 'ECA';
    const PAYMENTMETHOD_AMERICANEXPRESS = 'AMX';
    const PAYMENTMETHOD_BILLPAY = 'BPY';
    const PAYMENTMETHOD_BILLSAFE = 'BSF';
    const PAYMENTMETHOD_CURABILL = 'CUR';
    const PAYMENTMETHOD_DINERSCLUB_DISCOVER = 'DIN';
    const PAYMENTMETHOD_IDEAL = 'DEA';
    const PAYMENTMETHOD_SOFORTUEBERWEISUNG = 'DIB';
    const PAYMENTMETHOD_IDEALVIASOFORTUEBERWEISUNG = 'DII';
    const PAYMENTMETHOD_DANKORT = 'DNK';
    const PAYMENTMETHOD_DELTAVISTA = 'DVI';
    const PAYMENTMETHOD_GERMANELV = 'ELV';
    const PAYMENTMETHOD_ESPONLINEUEBERWEISUNG = 'ESP';
    const PAYMENTMETHOD_SWISSCOMEASYPAY = 'ESY';
    const PAYMENTMETHOD_JCB = 'JCB';
    const PAYMENTMETHOD_JELMOLIBONUSCARD = 'JEL';
    const PAYMENTMETHOD_MAESTRO = 'MAU';
    const PAYMENTMETHOD_MEDIAMARKTSHOPPINGCARD = 'MMS';
    const PAYMENTMETHOD_MFGROUPCHECKOUT = 'MFA';
    const PAYMENTMETHOD_MFGROUPFINANCIALREQUEST = 'MFG';
    const PAYMENTMETHOD_MFGROUPEASYINTEGRATION = 'MFX';
    const PAYMENTMETHOD_MONEYBOOKERS = 'MNB';
    const PAYMENTMETHOD_PAYPAL = 'PAP';
    const PAYMENTMETHOD_SWISSPOSTFINANCEEFINANCE = 'PEF';
    const PAYMENTMETHOD_SWISSPOSTFINANCECARD = 'PFC';
    const PAYMENTMETHOD_PAYSAFECARD = 'PSC';
    const PAYMENTMETHOD_CASHTICKET = 'PST';
    const PAYMENTMETHOD_PAYOLUTIONINSTALLMENTS = 'PYL';
    const PAYMENTMETHOD_PAYOLUTIONINVOICE = 'PYO';
    const PAYMENTMETHOD_REKACARD = 'REK';
    const PAYMENTMETHOD_SWISSBILLING = 'SWB';
    const PAYMENTMETHOD_SATURNWINNERCARD = 'SWC';

    const MONTH_JANUARY = '01';
    const MONTH_FEBRUARY = '02';
    const MONTH_MARCH = '03';
    const MONTH_APRIL = '04';
    const MONTH_MAY = '05';
    const MONTH_JUNE = '06';
    const MONTH_JULY = '07';
    const MONTH_AUGUST = '08';
    const MONTH_SEBTEMBER = '09';
    const MONTH_OCTOBER = '10';
    const MONTH_NOVEMBER = '11';
    const MONTH_DECEMBER = '12';
}
