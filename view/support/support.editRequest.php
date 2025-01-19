<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!$supportRequest) {
    echo "No se encontraron datos para la solicitud de soporte.";
    exit();
}
$selectedLanguage = html_entity_decode($supportRequest['language'], ENT_QUOTES, 'UTF-8');
var_dump($selectedLanguage);
$selectedPriority = htmlspecialchars($supportRequest['priority']);

$languages = [
    "Chino", "Japonés", "Ruso", "Árabe", "Coreano", "Hindi", "Bengalí", "Holandés", 
    "Sueco", "Noruego", "Danés", "Polaco", "Griego", "Turco", "Hebreo", "Vietnamita", 
    "Tailandés", "Malayo", "Indonesio", "Finlandés"
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Solicitud de Soporte</title>
</head>
<?php require_once HEADER ?>
<body>
<main>
    <div class="div-form">
            <form action="index.php?c=support&f=updateRequest" method="POST" id="form-contact" onsubmit="validateLanguage()">
                <h3>Actualiza los datos de tu solicitud</h3>
                <input type="hidden" name="requestId" value="<?php echo htmlspecialchars($supportRequest['requestId']); ?>">
                <label for="language">Idioma: </label>
                <select name="language" id="language">
                    <?php foreach ($languages as $language): ?>
                        <option value="<?php echo $language; ?>" <?php echo (html_entity_decode($selectedLanguage, ENT_QUOTES, 'UTF-8') === html_entity_decode($language, ENT_QUOTES, 'UTF-8')) ? 'selected' : ''; ?>>
                            <?php echo $language; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php foreach ($languages as $language): ?>
                    <?php var_dump(trim($language)); ?>
                    <?php var_dump(trim($selectedLanguage)); ?>
                    <?php endforeach; ?>
                <label for="priority">Prioridad: </label>
                <div>
                    <input type="radio" id="low" name="priority" value="Baja" <?php echo ($selectedPriority == 'Baja') ? 'checked' : ''; ?> required>
                    <label for="baja">Baja</label>
                    <input type="radio" id="medium" name="priority" value="Media" <?php echo ($selectedPriority == 'Media') ? 'checked' : ''; ?> required>
                    <label for="media">Media</label>
                    <input type="radio" id="high" name="priority" value="Alta" <?php echo ($selectedPriority == 'Alta') ? 'checked' : ''; ?> required>
                    <label for="alta">Alta</label>
                </div>
                <label for="subject">Asunto: </label>
                <input type="text" id="subject" name="subject" required value="<?php echo htmlspecialchars($supportRequest['subject']) ?>">
                <label for="description">Descripción: </label>
                <textarea name="description" id="description" required><?php echo htmlspecialchars($supportRequest['description']); ?></textarea>
                <div>
                    <input type="submit" value="Enviar">
                    <input type="reset" value="Cancelar" onclick="window.location.href='index.php?c=support&f=showUserRequests'">
                </div>
            </form>
        </div>
        <script>
            const validateLanguage = () => {
                const language = document.getElementById('language');
                if (language.value === 'info') {
                    alert('Seleccione un idioma');
                    return false;
                }
                return true;
            }
        </script>
    </main>
</body>
</html>
