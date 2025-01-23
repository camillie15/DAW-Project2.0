<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ResolveIT</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/userStyle.css">
</head>

<main class="main">
    <!-- Botones de login y registro -->
    <div class="profile-container">
        <!-- Logo dentro del main -->
        <a class="logo-div" style="color: #000; display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img class="logo-img" src="assets/img/logo.png" alt="Logo empresa" width="50" height="50">
            <h1 id="logo-name" style="margin: 0;">ResolveIT</h1>
        </a>

        <div class="accions">
            <a href="index.php?c=user&f=login">
                <button type="submit" class="btn btn-primary">Login</button>
            </a>
            <a href="index.php?c=user&f=register">
                <button type="submit" class="btn btn-primary">Register</button>
            </a>

        </div>

    </div>
</main>

<?php require_once FOOTER; ?>

</html>