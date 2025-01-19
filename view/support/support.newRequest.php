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
            <form action="index.php?c=support&f=createRequest" method="POST" id="form-contact" onsubmit="validateLanguage()">
                <h3>Envía tu solicitud y el equipo de soporte te dará una respuesta</h3>
                <div>
                    <label for="language">Idioma: </label>
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
                    <label for="priority">Prioridad: </label>
                    <input type="radio" id="low" name="priority" value="Baja" required>
                    <label for="low">Baja</label>
                    <input type="radio" id="medium" name="priority" value="Media" required>
                    <label for="medium">Media</label>
                    <input type="radio" id="high" name="priority" value="Alta" required>
                    <label for="high">Alta</label>
                </div>
                <div>
                    <label for="subject">Asunto: </label>
                    <input type="text" id="subject" name="subject" required placeholder="Ingrese el asunto">
                </div>
                <div>
                    <label for="description">Descripción: </label>
                    <textarea name="description" id="description" required placeholder="Ingrese la descripción de la solicitud"></textarea>
                </div>
                <div>
                    <input type="submit" value="Enviar">
                    <input type="reset" value="Cancelar" onclick="window.location.href='index.php?c=support&f=showRequests'">
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