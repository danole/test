<?php

namespace App\Model;

use SimpleXMLElement;

class GetData
{
    public $date;
    public $prevDate;

    public function getDataInDate()
    {
        $fileName = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $this->date;
        $prevFileName = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $this->prevDate;
        $string = file_get_contents($fileName);
        $prevDataString = file_get_contents($prevFileName);
        $xml = new SimpleXMLElement($string);
        $prevDataXml = new SimpleXMLElement($prevDataString);

        return $array = [$xml, $prevDataXml];
    }
}