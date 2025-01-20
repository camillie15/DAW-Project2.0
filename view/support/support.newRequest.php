<?php
if (!isset($_SESSION)) {
    session_start();
}
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
    <title>Nueva Solicitud de Soporte</title>
    <link rel="stylesheet" href="assets/css/support.css">
</head>
<?php require_once HEADER ?>
<body>
    <main>
        <div class="div-form">
            <form action="index.php?c=support&f=create_request" method="POST" id="form-contact" onsubmit="validateLanguage()">
                <h3>Envía tu solicitud y el equipo de soporte te dará una respuesta</h3>
                <div>
                    <label class="label-bold" for="subject">Asunto: </label>
                    <input type="text" id="subject" name="subject" required placeholder="Ingrese el asunto" maxlength="150">
                </div>
                <div>
                    <label class="label-bold" for="description">Descripción: </label>
                    <textarea name="description" id="description" required placeholder="Ingrese la descripción de la solicitud" maxlength="250"></textarea>
                </div>
                <div>
                    <label class="label-bold" for="language">Idioma: </label>
                    <select name="language" id="language">
                        <option id="info-option-language" value="info" selected disabled>Seleccione el idioma...</option>
                        <?php foreach ($languages as $language): ?>
                            <option value="<?php echo $language; ?>">
                                <?php echo $language; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="label-bold" for="priority">Prioridad: </label>
                    <div class="div-radio-group">
                        <div class="radio-group">
                            <input type="radio" id="low" name="priority" value="Baja" required>
                            <label style="font-weight=none;" for="low">Baja</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" id="medium" name="priority" value="Media" required>
                            <label for="medium">Media</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" id="high" name="priority" value="Alta" required>
                            <label for="high">Alta</label>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="checkbox" id="terms">
                    <label for="terms">Acepto los términos y condiciones</label>
                </div>
                <div class="div-buttons">
                    <input type="submit" value="Enviar">
                    <input type="reset" value="Cancelar" onclick="window.location.href='index.php?c=support&f=show_requests'">
                </div>
            </form>
        </div>
        <script>
            const validateLanguage = () => {
                const language = document.getElementById('language');
                if (language.value === 'info') {
                    event.preventDefault();
                    alert('Seleccione un idioma');
                    return false;
                }
                return true;
            }
        </script>
    </main>
</body>
</html>