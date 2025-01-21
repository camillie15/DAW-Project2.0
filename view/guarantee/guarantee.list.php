<?php require_once HEADER; ?>
<main>
    <h2>Lista de solicitudes de garantía</h2>
    <a href="index.php?c=guarantee&f=insertForm">Crear solicitud de garantía</a>
    <table>
        <thead>
            <tr>
                <th>Fecha de la compra (dd/mm/YY)</th>
                <th>Razón de garantía</th>
                <th>Código del producto</th>
                <th>Código de factura</th>
                <th>Descripción</th>
                <th>Estado</th>
                <?php if ($_SESSION['rol'] == 1): ?>
                    <th>Acciones</th>
                <?php elseif ($_SESSION['rol'] == 2): ?>
                    <th>Usuario</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($guarantees)) { ?>
                <tr>
                    <td colspan="7">No hay solicitudes de garantía</td>
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
                        <td>
                            <?php echo htmlspecialchars($guarantee['warrantyReasonName']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($guarantee['productCode']); ?></td>
                        <td><?php echo htmlspecialchars($guarantee['invoiceCode']); ?></td>
                        <td><?php echo htmlspecialchars($guarantee['description']); ?></td>

                        <?php if ($_SESSION['rol'] == 1): ?>
                            <td><?php echo htmlspecialchars($guarantee['requestStatusName']); ?></td>
                        <?php elseif ($_SESSION['rol'] == 2): ?>
                            <td>
                                <form
                                    action="index.php?c=guarantee&f=updateStatus&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>"
                                    method="post">
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="0" <?php echo $guarantee['requestStatus'] == 0 ? 'selected' : ''; ?>>Pendiente
                                        </option>
                                        <option value="1" <?php echo $guarantee['requestStatus'] == 1 ? 'selected' : ''; ?>>Aprobada
                                        </option>
                                        <option value="2" <?php echo $guarantee['requestStatus'] == 2 ? 'selected' : ''; ?>>Rechazada
                                        </option>
                                    </select>
                                </form>
                            </td>
                        <?php endif; ?>

                        <?php if ($_SESSION['rol'] == 1): ?>
                            <td>
                                <a
                                    href="index.php?c=guarantee&f=editForm&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>">Editar</a>
                                <a href="index.php?c=guarantee&f=delete&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>"
                                    onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">Eliminar</a>
                            </td>
                        <?php elseif ($_SESSION['rol'] == 2): ?>
                            <td><?php echo htmlspecialchars($guarantee['userName']); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php require_once FOOTER; ?>