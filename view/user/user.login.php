<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ResolveIT - Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/userStyle.css">

</head>

<body>
  <main class="main">
    <div class="profile-container">
      <h1>Login</h1>
      <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
      <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
        <p class="error-msg" style="color: red;">Usuario o contraseña incorrectos.</p>
      <?php endif; ?>
      <div>
      <form method="POST" action="index.php?c=user&f=processLogin">
        <label for="userName">Username</label>
        <input type="text" id="userName" name="userName" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn btn-primary">Login</button>
      </form>
      </div>
      <!-- Mensaje para usuarios que no tienen cuenta -->
      <p>No tienes cuenta? <a href="index.php?c=user&f=register">Regístrate aquí</a></p>
    </div>
  </main>
  <?php require_once FOOTER; ?>
</body>

</html>