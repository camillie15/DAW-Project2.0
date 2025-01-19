<?php 
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes de Soporte</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<?php require_once HEADER ?>

<body>
<main>
    <div>
        <h2>Datos de la solcitud</h2>
        <h4>Asunto: <?php echo html_entity_decode($supportRequest['subject'], ENT_QUOTES, 'UTF-8'); ?></h4>
        <p>Descripción: <?php echo html_entity_decode($supportRequest['description'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
    <div>
        <form action="index.php?c=support&f=createResponse" method="POST">
        <input type="hidden" name="requestId" value="<?php echo htmlspecialchars($_GET['requestId']); ?>">
            <label for="response">Respuesta</label>
            <textarea name="response" id="response"></textarea>
            <input type="submit" value="Responder">
        </form>
    </div>
</main>
<?php require_once FOOTER ?>
</body>

</html>