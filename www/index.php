<?php
require "../vendor/autoload.php";

use Base\View;

//Кидает в контроллер index
if ($_SERVER["REQUEST_URI"] == '/') {
    header("Location:index/index");
}

$part = explode('/', $_SERVER["REQUEST_URI"]); //Разбиваем написанное в адресной строке на на части
$contollerName = $part[1]; //Элемент 1 становится названием контроллера
$actionName = $part[2];//Элемент 2 часть названия метода в контроллере
$controllerFileName = 'App\Controller\\' . ucfirst(strtolower($contollerName));//NameSpace для Контроллера
$actionFuncName = $actionName . "Action";//Название метода в контроллере
$object = new $controllerFileName;//Создаем обьект контроллера
$object->$actionFuncName();//Вызываем метод контроллера который прописан в адресной строке
$tpl = '../App/Templates/' . ucfirst(strtolower($contollerName)) . "/" . $actionName . ".phtml";//Положение шаблона для метода
$view = new View();//Создаем обьект View
$object->view = $view; //Помещаем обьект View в переменную $view в контроллере
$object->view->render($tpl, $object);//Вызываем метод рендер,который подключает шаблон