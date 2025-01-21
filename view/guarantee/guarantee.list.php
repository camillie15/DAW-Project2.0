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
                <th>Acciones</th>
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
                        <td><?php echo htmlspecialchars($guarantee['requestStatusName']); ?></td>
                        <td>
                            <a href="index.php?c=guarantee&f=editForm&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>">Editar</a>
                            <a href="index.php?c=guarantee&f=delete&id=<?php echo htmlspecialchars($guarantee['guaranteeId']); ?>" onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php require_once FOOTER; ?>