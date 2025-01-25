<?php require_once HEADER; 
// autor: Daniel Mateo Aguilar Villafuerte
?>

<main class="profile-container">
    <h1>Bienvenido a tu perfil, <b><?php echo $_SESSION['userLogged']->getUserName(); ?></b></h1>
    
    <!-- Datos del Usuario -->
    <h2 class="user-title">Datos del Usuario</h2>
    <div class="user-data">
        <label for="firstName">First Name:</label> 
        <span id="firstName"><?php echo $_SESSION['userLogged']->getFirstName(); ?></span><br>

        <label for="lastName">Last Name:</label> 
        <span id="lastName"><?php echo $_SESSION['userLogged']->getLastName(); ?></span><br>

        <label for="userName">Username:</label> 
        <span id="userName"><?php echo $_SESSION['userLogged']->getUserName(); ?></span><br>

        <label for="email">Email:</label> 
        <span id="email"><?php echo $_SESSION['userLogged']->getEmail(); ?></span><br>
    </div>

    <!-- Botones -->
    <div class="actions">
        <form action="index.php?c=user&f=updateProfile" method="POST">
            <button type="submit" class="btn btn-primary">Actualizar Datos</button>
        </form>

        <form action="index.php?c=user&f=deleteAccount" method="POST" onsubmit="return confirmDelete()">
            <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
        </form>
    </div>
</main>

<script>
    function confirmDelete() {
        return confirm("¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.");
    }
</script>

<?php require_once FOOTER; ?>
