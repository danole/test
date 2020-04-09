<?php

namespace App\Controller;

use App\Model\GetData;
use DateTime;

class Index
{
    public $view;
    public $data;
    public $usd;
    public $xml;
    public $evro;
    public $prevEvro;
    public $prevUsd;

    public function indexAction()
    {
        echo "<p>Выберите дату,чтобы посмотреть курс валют</p>";
    }

    public function showAction()
    {
        $this->data=new GetData();
        $dateTime = new DateTime($_POST['date']);
        $this->data->date=$dateTime->format('d/m/Y');
        $prevDate=$dateTime->modify('-1 day');
        $this->data->prevDate=$prevDate->format('d/m/Y');
        $this->xml=$this->data->getDataInDate();

        foreach ($this->xml['0'] as $item) {
            if ($item->attributes()->ID == 'R01235') {
                $this->usd = $item;
            }
        }

        foreach ($this->xml['0'] as $item) {
            if ($item->attributes()->ID == 'R01239') {
                $this->evro = $item;
            }
        }

        foreach ($this->xml['1'] as $item) {
            if ($item->attributes()->ID == 'R01239') {
                $this->prevEvro = $item;
            }
        }

        foreach ($this->xml['1'] as $item) {
            if ($item->attributes()->ID == 'R01235') {
                $this->prevUsd = $item;
            }
        }
    }

}