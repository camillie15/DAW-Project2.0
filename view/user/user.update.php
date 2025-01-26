<!-- autor: Aguilar Villafuerte Daniel Mateo -->
<?php require_once HEADER; ?>

<main class="profile-container">
    <h1 class="user-title">Actualizar Datos</h1>
    
    <!-- Formulario de Actualización -->
    <form action="index.php?c=user&f=processUpdate" method="POST" class="form-container">
        <div class="user-data">
            <label for="firstName" class="form-label">Nombre:</label>
            <input type="text" name="firstName" class="form-input" value="<?php echo $_SESSION['userLogged']->getFirstName(); ?>" required><br>

            <label for="lastName" class="form-label">Apellido:</label>
            <input type="text" name="lastName" class="form-input" value="<?php echo $_SESSION['userLogged']->getLastName(); ?>" required><br>

            <label for="userName" class="form-label">Usuario:</label>
            <input type="text" name="userName" class="form-input" value="<?php echo $_SESSION['userLogged']->getUserName(); ?>" required><br>

            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" class="form-input" value="<?php echo $_SESSION['userLogged']->getEmail(); ?>" required><br>

            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" class="form-input" value="<?php echo $_SESSION['userLogged']->getPassword(); ?>" required><br>
        </div>
        
        <!-- Botón para actualizar -->
        <div class="actions">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>

    <!-- Botón de eliminar (opcional) -->
    <div class="actions">
        <button type="button" class="btn btn-danger">Eliminar Cuenta</button>
    </div>
</main>

<?php require_once FOOTER; ?>
