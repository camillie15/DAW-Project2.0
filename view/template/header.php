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
</head>


<header>
  <a href="/" class="logo-div" style="color: #000;">
    <img class="logo-img" src="src/logo.png" alt="Logo empresa" width="50" height="50">
    <h1 id="logo-name">ResolveIT</h1>
  </a>

  <!-- Nvegacion para el usuario cliente -->
  <?php
  if ($rol == 1) {
  ?>
    <nav class="nav-links">
      <a href="#">Devolucion</a>
      <a href="#">Garantia</a>
      <a href="#">FAQ</a>
      <a href="#">Contactar</a>
    </nav>
  <?php
  }
  ?>

  <!-- Nvegacion para el usuario empleado encargado de administrar las peticiones retornos y devoluciones  -->
  <?php
  if ($rol == 2) {
  ?>
    <nav class="nav-links">
      <a href="#">Devoluciones</a>
      <a href="#">Garantias</a>
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
      <a href="#">Contactar</a>
    </nav>
  <?php
  }
  ?>


  <div id="header-right">
    <a href="#">Cerrar Sesión</a>
  </div>
</header>