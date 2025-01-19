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
<body>
    <?php require_once HEADER ?>
    <main>
        <div id="supportHeader">
            <h1>Lista de Solicitudes de Soporte</h1>
            <?php if ($_SESSION['rol'] == 1): ?>
                <a href="index.php?c=support&f=newRequest" id="btn-new-request">Nueva Solicitud</a>
            <?php endif; ?>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Asunto</th>
                        <th>Descripción</th>
                        <th>Prioridad</th>
                        <th>Fecha de la solicitud</th>
                        <?php if ($_SESSION['rol'] == 1): ?>
                            <th>Idioma</th>
                        <?php endif; ?>
                        <th>Estado</th>
                        <th>...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($supportRequests)): ?>
                        <?php foreach ($supportRequests as $request): ?>
                            <tr>
                                    <?php if ($_SESSION['rol'] == 1): ?>
                                        <td><?php echo $request['requestId']; ?></td>
                                        <td><?php echo html_entity_decode($request['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo html_entity_decode($request['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo $request['priority']; ?></td>
                                        <td class="date-cell">
                                            <?php 
                                                $date = new DateTime($request['requestDate']);
                                                echo $date->format('d-m-Y'); 
                                            ?>
                                            <br>
                                            <?php echo $date->format('H:i'); ?>
                                        </td>
                                        <?php if ($_SESSION['rol'] == 1): ?>
                                            <td><?php echo $request['language']; ?></td>
                                        <?php endif; ?>
                                        <td><?php echo ($request['requestStatus'] == 0) ? 'Pendiente' : 'Resuelta'; ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="index.php?c=support&f=editRequest&requestId=<?php echo $request['requestId']; ?>"> 
                                                    <i class="bi bi-pencil-square"></i> 
                                                </a> 
                                                <a href="#" data-request-id="<?php echo $request['requestId']; ?>"> 
                                                    <i class="bi bi-trash"></i> 
                                                </a> 
                                                <a href="#" data-request-id="<?php echo $request['requestId']; ?>"> 
                                                    <i class="bi bi-eye"></i> 
                                                </a>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td><?php echo $request['requestId']; ?></td>
                                        <td><?php echo html_entity_decode($request['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo html_entity_decode($request['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo $request['priority']; ?></td>
                                        <td><?php echo (new DateTime($request['requestDate']))->format('d-m-Y H:i'); ?></td>
                                        <td><?php echo ($request['requestStatus'] == 0) ? 'Pendiente' : 'Resuelta'; ?></td>
                                        <td>
                                            <a href="index.php?c=support&f=newResponse&requestId=<?php echo $request['requestId']; ?>">
                                                Responder
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8">No se encontraron solicitudes de soporte.</td>
                    </tr>
                    <?php endif; ?>
            </tbody>
            </table>
        </div>
            <div id="confirmDeleteModal" style="display: none;">
            <div>
                <div>
                    <div>
                        <h5>Confirmar Eliminación</h5>
                    </div>
                    <label>¿Estás seguro de que deseas eliminar esta solicitud de soporte?</label>
                    <div>
                        <button type="button">Cancelar</button>
                        <a href="" id="confirmDeleteButton">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="responseModal" style="display: none;">
            <div>
                <div>
                    <h5 id="modalTitle">Detalle de la respuesta</h5>
                    <div id="responseContent">

                    </div>
                    <div>
                        <button type="button" id="closeModalButton">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/js/support.js"></script>

    <?php require_once FOOTER ?>

</body>

</html>