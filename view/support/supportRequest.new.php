<?php
if (!isset($_SESSION)) session_start();
if (!empty($_SESSION['userLogged'])) {
    $user = $_SESSION['userLogged' ];
    $rol = $user->getRol();
    } else { 
        $rol = 1; 
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Solicitud de Soporte</title>
</head>
<?php require_once HEADER ?>

<body>

</body>
</html>
