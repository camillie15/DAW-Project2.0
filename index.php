<?php
//FrontController
require_once 'conf/config.php';
// leer parametros

$controlador = (!empty($_REQUEST['c'])) ? htmlentities($_REQUEST['c']) : CONTROLADOR_PRINCIPAL;

// index
$controlador = ucwords(strtolower($controlador)) . "Controller";

//IndexController
$funcion = (!empty($_REQUEST['f'])) ? htmlentities($_REQUEST['f']) : FUNCION_PRINCIPAL;

require_once 'controller/' . $controlador . '.php';

$cont = new  $controlador(); // creacion del objeto controlador 
$cont->$funcion();// llamada a la funcion del controlador
