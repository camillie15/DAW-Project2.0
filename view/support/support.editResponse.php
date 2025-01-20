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
    <link rel="stylesheet" href="assets/css/support.css">
</head>
<?php require_once HEADER ?>

<body>
<main>
    <div class="div-form">
        <div class="div-data-request">
            <h2>Datos de la solicitud</h2>
            <p><strong>Asunto:</strong>&nbsp;&nbsp;<?php echo html_entity_decode($supportRequest['subject'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Descripción:</strong>&nbsp;&nbsp;<?php echo html_entity_decode($supportRequest['description'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <form action="index.php?c=support&f=update_response" method="POST">
            <input type="hidden" name="responseId" value="<?php echo htmlspecialchars($supportResponse['responseId']); ?>">
            <input type="hidden" name="requestId" value="<?php echo htmlspecialchars($supportResponse['requestId']); ?>">
            <label class="label-bold" for="response">Respuesta</label>
            <textarea name="response" id="response" maxlength="250"><?php echo html_entity_decode($supportResponse['response'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div class="div-buttons">
                <input type="submit" value="Actualizar respuesta">
            </div>
        </form>
    </div>
</main>
<?php require_once FOOTER ?>
</body>

</html>