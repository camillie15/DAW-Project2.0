<!--  autor: Ayovi Villafuerte Camillie Thais -->
<?php require_once HEADER ?>

<main class="main-support">
    <div class="div-form">
        <div class="div-data-request">
            <h2>Datos de la solicitud</h2>
            <p><strong>Asunto:</strong>&nbsp;&nbsp;<?php echo html_entity_decode($supportRequest['subject'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Descripción:</strong>&nbsp;&nbsp;<?php echo html_entity_decode($supportRequest['description'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <form action="index.php?c=support&f=create_response" method="POST">
        <input type="hidden" name="requestId" value="<?php echo htmlspecialchars($_GET['requestId']); ?>">
            <label class="label-bold" for="response">Respuesta</label>
            <textarea name="response" id="response" maxlength="250" required></textarea>
            <div class="div-buttons">
                <input type="submit" value="Responder">
            </div>
        </form>
    </div>
</main>

<?php require_once FOOTER ?>