<?php

namespace Base;

class View
{
    public function render($tpl, $object)
    {
        ob_start();
        include $tpl;
        echo ob_get_clean();
    }

}