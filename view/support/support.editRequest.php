<?php     // autor: Camillie Thais Ayovi Villafuerte
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!$supportRequest) {
    echo "No se encontraron datos para la solicitud de soporte.";
    exit();

}
$selectedLanguage = html_entity_decode($supportRequest['language'], ENT_QUOTES, 'UTF-8');
$selectedPriority = htmlspecialchars($supportRequest['priority']);

$languages = [
    "Chino", "Japonés", "Ruso", "Árabe", "Coreano", "Hindi", "Bengalí", "Holandés", 
    "Sueco", "Noruego", "Danés", "Polaco", "Griego", "Turco", "Hebreo", "Vietnamita", 
    "Tailandés", "Malayo", "Indonesio", "Finlandés"
];

?>

<?php require_once HEADER ?>

<main class="main-support">
    <div class="div-form">
        <form action="index.php?c=support&f=update_request" method="POST" id="form-contact">
            <h3>Actualiza los datos de tu solicitud</h3>
            <input type="hidden" name="requestId" value="<?php echo htmlspecialchars($supportRequest['requestId']); ?>">
            <div>
                <label class="label-bold" for="subject">Asunto: </label>
                <input type="text" id="subject" name="subject" required value="<?php echo htmlspecialchars($supportRequest['subject']) ?>" maxlength="150">
                </div>
            <div>
                <label class="label-bold" for="description">Descripción: </label>
                <textarea name="description" id="description" required maxlength="250"><?php echo htmlspecialchars($supportRequest['description']); ?></textarea>
            </div>
            <div>
                <label class="label-bold" for="language">Idioma: </label>
                <select name="language" id="language">
                    <?php foreach ($languages as $language): ?>
                        <option value="<?php echo $language; ?>" <?php echo (html_entity_decode($selectedLanguage, ENT_QUOTES, 'UTF-8') === html_entity_decode($language, ENT_QUOTES, 'UTF-8')) ? 'selected' : ''; ?>>
                            <?php echo $language; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="label-bold" for="priority">Prioridad: </label>
                <div class="div-radio-group">
                    <div class="radio-group">
                        <input type="radio" id="low" name="priority" value="Baja" <?php echo ($selectedPriority == 'Baja') ? 'checked' : ''; ?> required>
                        <label for="baja">Baja</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" id="medium" name="priority" value="Media" <?php echo ($selectedPriority == 'Media') ? 'checked' : ''; ?> required>
                        <label for="media">Media</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" id="high" name="priority" value="Alta" <?php echo ($selectedPriority == 'Alta') ? 'checked' : ''; ?> required>
                        <label for="alta">Alta</label>
                    </div>
                </div>
            </div>
            <div class="div-buttons">
                <input class="btn" type="submit" value="Enviar">
                <input class="btn" type="reset" value="Cancelar" onclick="window.location.href='index.php?c=support&f=show_requests'">
            </div>
        </form>
    </div>
</main>

<?php require_once FOOTER ?>
