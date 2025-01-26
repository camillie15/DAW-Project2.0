<!-- autor: Tipan Anton Cesar Alexander -->
<?php require_once HEADER; ?>

<main class="main-content-guarantee guarantee-main">
    <section class="guarantee-list">
        <h2 class="page-title">Lista de solicitudes de garantía</h2>
        <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
            <a href="index.php?c=guarantee&f=insertForm" class="actions-guarantee">Crear solicitud de
                garantía</a>
        <?php endif; ?>
        <section style="width: 100%; overflow-x: auto;">
            <table class="table-guarantee">
                <thead>
                    <tr>
                        <th>Fecha de la compra</th>
                        <th>Razón de garantía</th>
                        <th>Código del producto</th>
                        <th>Código de factura</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
                            <th>Acciones</th>
                        <?php elseif ($_SESSION['userLogged']->getUserRole() == 2): ?>
                            <th>Usuario</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($guarantees)) { ?>
                        <tr>
                            <td colspan="7" class="no-data">No hay solicitudes de garantía</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($guarantees as $guarantee) { ?>
                            <tr>
                                <td>
                                    <?php
                                    $date = new DateTime($guarantee['purchaseDate']);
                                    echo $date->format('d/m/Y');
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($guarantee['warrantyReasonName']); ?></td>
                                <td><?php echo htmlspecialchars($guarantee['productCode']); ?></td>
                                <td><?php echo htmlspecialchars($guarantee['invoiceCode']); ?></td>
                                <td><?php echo htmlspecialchars($guarantee['description']); ?></td>

                                <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
                                    <td><?php echo htmlspecialchars($guarantee['requestStatusName']); ?></td>
                                <?php elseif ($_SESSION['userLogged']->getUserRole() == 2): ?>
                                    <td>
                                        <form
                                            action="index.php?c=guarantee&f=updateStatus&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>"
                                            method="post" class="status-form">
                                            <select name="status" class="status-select" onchange="this.form.submit()">
                                                <option value="0" <?php echo $guarantee['requestStatus'] == 0 ? 'selected' : ''; ?>>
                                                    Pendiente
                                                </option>
                                                <option value="1" <?php echo $guarantee['requestStatus'] == 1 ? 'selected' : ''; ?>>
                                                    Aprobada
                                                </option>
                                                <option value="2" <?php echo $guarantee['requestStatus'] == 2 ? 'selected' : ''; ?>>
                                                    Rechazada
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                <?php endif; ?>

                                <?php if ($_SESSION['userLogged']->getUserRole() == 1): ?>
                                    <td>
                                        <div class="actions-garantee">
                                            <a href="index.php?c=guarantee&f=editForm&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>"
                                                class="btn-guarantee">Editar</a>

                                            <button class="btn-guarantee btn-delete"
                                                data-id="<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>">Eliminar</button>
                                        </div>
                                    </td>
                                <?php elseif ($_SESSION['userLogged']->getUserRole() == 2): ?>
                                    <td><?php echo htmlspecialchars($guarantee['userName']); ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </section>
</main>

<div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h3>Confirmar Eliminación</h3>
        <p>¿Estás seguro de que deseas eliminar esta solicitud?</p>
        <div class="modal-actions">
            <button id="cancelDelete" class="btn-cancel">Cancelar</button>
            <a d="confirmDelete" class="btn-confirm" href="index.php?c=guarantee&f=delete&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>">Eliminar</a>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const guaranteeId = this.dataset.id;
            const modal = document.getElementById('deleteModal');
            const confirmDelete = document.getElementById('confirmDelete');
            modal.style.display = 'block';
            confirmDelete.href = `index.php?c=guarantee&f=delete&id=${guaranteeId}`;
        });
    });

    document.getElementById('cancelDelete').addEventListener('click', function () {
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'none';
    });
</script>

<?php require_once FOOTER; ?>