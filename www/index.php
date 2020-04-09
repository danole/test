<?php
require "../vendor/autoload.php";

use Base\View;

if ($_SERVER["REQUEST_URI"]=='/'){
header("Location:index/index");
}

$part = explode('/', $_SERVER["REQUEST_URI"]);
$contollerName = $part[1];
$actionName = $part[2];
$controllerFileName = 'App\Controller\\' . ucfirst(strtolower($contollerName));
$actionFuncName = $actionName . "Action";
$object = new $controllerFileName;
$object->$actionFuncName();
$tpl = '../App/Templates/' . ucfirst(strtolower($contollerName)) . "/" . $actionName . ".phtml";
$view = new View();
$object->view = $view;
$object->view->render($tpl, $object);