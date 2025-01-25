<?php require_once HEADER 
    // autor: Camillie Thais Ayovi Villafuerte
?>

<main class="main-support">
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
            <textarea name="response" id="response" maxlength="250" required><?php echo html_entity_decode($supportResponse['response'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            <div class="div-buttons">
                <input type="submit" value="Actualizar respuesta">
            </div>
        </form>
    </div>
</main>

<?php require_once FOOTER ?>