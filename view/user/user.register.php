<!-- autor: Aguilar Villafuerte Daniel Mateo -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ResolveIT - Register</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/userStyle.css">
</head>

<body>
  <main class="main">
    <div class="profile-container">
      <h1>Register</h1>
      <form method="POST" action="index.php?c=user&f=processRegister" class="form-container register-form">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" id="firstName" name="firstName" class="form-input" required>

        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" id="lastName" name="lastName" class="form-input" required>

        <label for="userName" class="form-label">Username</label>
        <input type="text" id="userName" name="userName" class="form-input" required>

        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-input" required>

        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-input" required>

        <button type="submit" class="btn btn-primary">Register</button>
      </form>
      <p>Ya tienes una cuenta? <a href="index.php?c=user&f=login">Inicia sesión aquí</a></p>
    </div>
  </main>
  <?php require_once FOOTER; ?>
</body>

</html>