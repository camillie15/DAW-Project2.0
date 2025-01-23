<?php
// FrontController
require_once 'conf/ConfigPaths.php';

// Leer parámetros de la URL
$controlador = (!empty($_REQUEST['c'])) ? htmlentities($_REQUEST['c']) : CONTROLADOR_PRINCIPAL;
$controlador = ucwords(strtolower($controlador)) . "Controller";

// Función a ejecutar
$funcion = (!empty($_REQUEST['f'])) ? htmlentities($_REQUEST['f']) : FUNCION_PRINCIPAL;

require_once 'controller/' . $controlador . '.php'; // Cargar el controlador

$cont = new $controlador(); // Crear el objeto controlador
$cont->$funcion(); // Llamar a la función del controlador