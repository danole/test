<?php

namespace App\Controller;

use App\Model\GetData;
use DateTime;

class Index
{
    public $view; //Переменная для обьекта View
    public $data; //Переменная для обьекта модели
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
        $this->data = new GetData();  //Создаю обьект модели
        $dateTime = new DateTime($_POST['date']); //Создаю обьект DateTime, чтобы поменять формат даты и получить предыдущий день
        $this->data->date = $dateTime->format('d/m/Y');// Меняю на нужный формат
        $prevDate = $dateTime->modify('-1 day');//Получаю предыдущий день
        $this->data->prevDate = $prevDate->format('d/m/Y');//Меняю формат предыдущего дня
        $this->xml = $this->data->getDataInDate();//Вызываю метод модели GetData, который получает xml с данными

        //Цикл,достающий из xml курс доллара
        foreach ($this->xml['0'] as $item) {
            if ($item->attributes()->ID == 'R01235') {
                $this->usd = $item;
            }
        }
        //Цикл,достающий из xml курс евро
        foreach ($this->xml['0'] as $item) {
            if ($item->attributes()->ID == 'R01239') {
                $this->evro = $item;
            }
        }
        //Цикл,достающий из xml евро за предыдущий день
        foreach ($this->xml['1'] as $item) {
            if ($item->attributes()->ID == 'R01239') {
                $this->prevEvro = $item;
            }
        }
        //Цикл,достающий из xml доллар за предыдущий день
        foreach ($this->xml['1'] as $item) {
            if ($item->attributes()->ID == 'R01235') {
                $this->prevUsd = $item;
            }
        }
    }

}