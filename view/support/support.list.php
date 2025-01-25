<?php     // autor: Camillie Thais Ayovi Villafuerte
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<?php require_once HEADER ?>
<main class="main-support">
    <div id="supportHeader">
        <?php if(isset($_SESSION['message'])):?>
            <p style="color: #0066ff;"><?php echo $_SESSION['message']?>
            <?php unset($_SESSION['message']); ?>
        <?php endif;?>
        <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
            <h1 class="title">Contáctanos</h1>
            <h3>Bienvenido a nuestra página de contacto</h3>
            <p>Aquí podrás crear una nueva solicitud de soporte, ver el historial de tus solicitudes anteriores y 
                ponerte en contacto con nosotros de la manera conveniente</p>
            <a href="index.php?c=support&f=form_create_request" class="btn-support">Nueva Solicitud</a>
            <h4>Solicitudes registradas:</h4>
        <?php else:?>
            <h2 class="title">Solicitudes de contacto</h2>
        <?php endif; ?>
    </div>
    <div>
        <table id="table-support">
            <thead>
                <tr>
                    <?php if ($_SESSION['userLogged']->getUserRole() == 3): ?>
                        <th>Usuario</th>
                    <?php else: ?>
                        <th>Id Solicitud</th>
                    <?php endif; ?>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Prioridad</th>
                    <th>Fecha de la solicitud</th>
                    <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
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
                            <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
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
                                <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
                                    <td><?php echo $request['language']; ?></td>
                                <?php endif; ?>
                                <td><?php echo ($request['requestStatus'] == 0) ? 'Pendiente' : 'Resuelta'; ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="index.php?c=support&f=form_update_request&requestId=<?php echo $request['requestId']; ?>"> 
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
                                <td><?php echo htmlentities($request['userName']); ?></td>
                                <td><?php echo html_entity_decode($request['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo html_entity_decode($request['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo $request['priority']; ?></td>
                                <td><?php echo (new DateTime($request['requestDate']))->format('d-m-Y H:i'); ?></td>
                                <td><?php echo ($request['requestStatus'] == 0) ? 'Pendiente' : 'Resuelta'; ?></td>
                                <td>
                                    <?php if($request['requestStatus'] == 0): ?>
                                        <a class="a-support" href="index.php?c=support&f=form_response&requestId=<?php echo $request['requestId']; ?>">
                                            Responder
                                        </a>
                                    <?php else: ?>
                                        <a class="a-support" href="index.php?c=support&f=form_response&requestId=<?php echo $request['requestId']; ?>">
                                            Actualizar respuesta
                                        </a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
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
        <div id="confirmDeleteContent">
            <div>
                <div>
                    <h4>Confirmar Eliminación</h4>
                </div>
                <label>¿Estás seguro de que deseas eliminar esta solicitud de soporte?</label>
                <div class="div-buttons-modal">
                    <button class="btn-support" type="button">Cancelar</button>
                    <a class="btn-support" href="" id="confirmDeleteButton">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
    <div id="responseModal" style="display: none;">
        <div id="responseModalContent">
            <h4 id="modalTitle">Detalle de la respuesta</h4>
            <div id="responseContent"></div>
            <div class="div-buttons-modal">
                <button class="btn-support" type="button" id="closeModalButton">Cerrar</button>
            </div>
        </div>
    </div>
</main>
    
<script src="assets/js/support.js"></script>

<?php require_once FOOTER ?>
