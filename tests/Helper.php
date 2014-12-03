<?php

namespace Ibrows\Tests\DataTrans;

class Helper
{
    /**
     * @param $iban
     * @param $country
     * @param $blz
     * @return string
     */
    public static function getAccountFromIbanCountryAndBlz($iban, $blz, $country)
    {
        return substr($iban, strlen($country) + strlen($blz) + 2);
    }
}
