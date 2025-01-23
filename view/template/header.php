<?php
require_once(__DIR__ . '/../../model/User.php');
if (!isset($_SESSION)) session_start();
// Verificar si el usuario está logueado
if (!empty($_SESSION['userLogged'])) {
  $user = $_SESSION['userLogged'];
  $rol = $user->getUserRole();  // Asegúrate de que el rol esté en el array de sesión.
} else {
  // Redirigir a la página de login si no existe el usuario logueado
  header('Location: index.php?c=user&f=index');
  exit();
}
if ($rol < 1 || $rol > 3) {
  header('Location: index.php?c=user&f=index');
  exit();
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
  <link rel="stylesheet" href="assets/css/guaranteeStyle.css">
  <link rel="stylesheet" href="assets/css/perfilStyle.css">
  <link rel="stylesheet" href="assets/css/faqStyle.css">
  <link rel="stylesheet" href="assets/css/faqEditStyle.css">
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
      <a href="index.php?c=guarantee&f=index">Garantia</a>
      <a href="index.php?c=faq&f=list_client_view">FAQ</a>
      <a href="index.php?c=support&f=show_requests">Contactar</a>
      <a href="index.php?c=user&f=perfil">Perfil</a>
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
      <a href="index.php?c=guarantee&f=listGuarantees">Peticiones de Garantia</a>
    </nav>
  <?php
  }
  ?>

  <!-- Nvegacion para el usuario empleado encargado de administrar las peticiones de FAQ y Contactenos-->
  <?php
  if ($rol == 3) {
  ?>
    <nav class="nav-links">
      <a href="index.php?c=faq&f=list_admin_view">FAQ</a>
      <a href="index.php?c=support&f=show_requests">Contactar</a>
    </nav>
  <?php
  }
  ?>
  <a class="nav-button" href="index.php?c=user&f=logout">Cerrar Sesión</a>
</header>