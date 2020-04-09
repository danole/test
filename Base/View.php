<?php

namespace Base;

class View
{
    public function render($tpl, $object) //Обьект контроллера,чтобы передать данные с него в шаблон
    {
        ob_start();
        include $tpl;    //Подключение шаблона
        echo ob_get_clean();
    }

}