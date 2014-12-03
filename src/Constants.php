<?php

namespace Ibrows\DataTrans;

class Constants
{
    const URL_AUTHORIZATION = 'https://payment.datatrans.biz/upp/jsp/upStart.jsp';
    const URL_XMLSETTLEMENT = 'https://payment.datatrans.biz/upp/jsp/XML_processor.jsp';

    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';
    const STATUS_CANCEL = 'cancel';

    const MSGTYPE_GET = 'web';
    const MSGTYPE_POST = 'post';
}
