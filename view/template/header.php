<?php
if (!isset($_SESSION)) session_start();

//Logica para asignar el rol a una variable para utilizar para el rol

if (!empty($_SESSION['userLogged'])) {
  $user = $_SESSION['userLogged'];
  $rol = $user->getRol();
} else {

  //Logica para redirigir a la pagina de login si no existe el usuario logeado
  //HEADER('Location: view/login.php');


  // Rol para pruebas
  $rol = 1;
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ResolveIT</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/returnStyle.css">
  <link rel="stylesheet" href="assets/css/support.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>


<header>
  <a href="index.php" class="logo-div" style="color: #000;">
    <img class="logo-img" src="assets/img/logo.png" alt="Logo empresa" width="50" height="50">
    <h1 id="logo-name">ResolveIT</h1>
  </a>

  <!-- Nvegacion para el usuario cliente -->
  <?php
  if ($rol == 1) {
  ?>
    <nav class="nav-links">
      <a href="index.php?c=returns&f=index">Devolucion</a>
      <a href="#">Garantia</a>
      <a href="#">FAQ</a>
      <a href="index.php?c=support&f=show_requests">Contactar</a>
    </nav>
  <?php
  }
  ?>

  <!-- Nvegacion para el usuario empleado encargado de administrar las peticiones retornos y devoluciones  -->
  <?php
  if ($rol == 2) {
  ?>
    <nav class="nav-links">
      <a href="index.php?c=returns&f=list_view">Peticiones de Devolucion</a>
      <a href="#">Peticiones de Garantia</a>
    </nav>
  <?php
  }
  ?>

  <!-- Nvegacion para el usuario empleado encargado de administrar las peticiones de FAQ y Contactenos-->
  <?php
  if ($rol == 3) {
  ?>
    <nav class="nav-links">
      <a href="#">FAQ</a>
      <a href="index.php?c=support&f=show_requests">Contactar</a>
    </nav>
  <?php
  }
  ?>
    <a class="nav-button" href="#">Cerrar Sesión</a>
</header>