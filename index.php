<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

// FrontController
require_once __DIR__ . '/conf/ConfigPaths.php';

// Leer parámetros de la URL
$controlador = (!empty($_REQUEST['c'])) ? htmlentities($_REQUEST['c']) : CONTROLADOR_PRINCIPAL;
$controlador = ucwords(strtolower($controlador)) . "Controller";

// Función a ejecutar
$funcion = (!empty($_REQUEST['f'])) ? htmlentities($_REQUEST['f']) : FUNCION_PRINCIPAL;

require_once __DIR__ . '/controller/' . $controlador . '.php'; // Cargar el controlador

$cont = new $controlador(); // Crear el objeto controlador
$cont->$funcion(); // Llamar a la función del controlador