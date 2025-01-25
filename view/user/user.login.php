<!-- // autor: Daniel Mateo Aguilar Villafuerte -->

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

      <form method="POST" action="index.php?c=user&f=processLogin" class="form-container login-form">
        <label for="userName" class="form-label">Username</label>
        <input type="text" id="userName" name="userName" class="form-input" required>

        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-input" required>

        <button type="submit" class="btn btn-primary">Login</button>

        <?php if (isset($_SESSION['login_error'])): ?>
          <p class="error-msg" style="color: red; font-weight: bold; margin-top: 10px;">
            <?= $_SESSION['login_error']; ?>
          </p>
          <?php unset($_SESSION['login_error']); ?>  <!-- Limpiar mensaje después de mostrarlo -->
        <?php endif; ?>
      </form>

      <p>No tienes cuenta? <a href="index.php?c=user&f=register">Regístrate aquí</a></p>
    </div>
  </main>
  <?php require_once FOOTER; ?>
</body>

</html>
