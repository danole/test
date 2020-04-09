<?php

namespace App\Model;

use SimpleXMLElement;

class GetData
{
    public $date;
    public $prevDate;

    public function getDataInDate()
    {
        $fileName = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $this->date; //Адресс с которого придет xml за искомый день
        $prevFileName = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $this->prevDate;//Адресс с которого придет xml за предыдущий день
        $string = file_get_contents($fileName);//Получаем данные
        $prevDataString = file_get_contents($prevFileName);
        $xml = new SimpleXMLElement($string);//Делаем из данных обьект с которым будем работать
        $prevDataXml = new SimpleXMLElement($prevDataString);

        return $array = [$xml, $prevDataXml];//Возвращаем данные
    }
}