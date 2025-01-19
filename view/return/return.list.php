<?php require_once HEADER ?>

<main>
    <h1><?= $title ?></h1>
    <?php if (isset($_GET['message'])): ?>
        <h2>
            <?= $_GET['message'] ?>
        </h2>
    <?php endif; ?>
    <table>
        <?php if ($_GET['f'] == "list_view"): ?>
            <h2>Vista empleado</h2>
        <?php endif; ?>

        <?php if ($_GET['f'] == "list_client_view"): ?>
            <h2>Vista cliente</h2>
        <?php endif; ?>
        <thead>
            <tr>
                <th>Estado de la solicitud</th>
                <th>Fecha de solicitud</th>
                <th>Fecha de compra</th>
                <th>Estado del producto</th>
                <th>Codigo del producto</th>
                <th>Codigo de la factura</th>
                <th>Descripcion</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($returns as $return): ?>
                <tr>
                    <td>
                        <?php
                        if ($return->getRequestStatus() == 0) {
                            echo "Pendiente";
                        } else if ($return->getRequestStatus() == 1) {
                            echo "Aprobado";
                        } else if ($return->getRequestStatus() == 2) {
                            echo "Rechazado";
                        }
                        ?>
                    </td>
                    <td>
                        <?= $return->getRequestDate() ?>
                    </td>
                    <td>
                        <?= $return->getPurchaseDate() ?>
                    </td>
                    <td>
                        <?= $return->getProductStatus() ?>
                    </td>
                    <td>
                        <?= $return->getProductCode() ?>
                    </td>
                    <td>
                        <?= $return->getInvoiceCode() ?>
                    </td>
                    <td>
                        <?= $return->getDescription() ?>
                    </td>
                    <?php if ($_GET['f'] == "list_client_view"): ?>
                        <td>
                            <a href="index.php?c=returns&f=update_view&id=<?= $return->getReturnId() ?>">Editar</a>
                        </td>
                        <td>
                            <a href="index.php?c=returns&f=delete_return&id=<?= $return->getReturnId() ?>">Eliminar</a>
                        </td>
                    <?php endif; ?>
                    <?php if ($_GET['f'] == "list_view"): ?>
                        <td>
                            <a href="index.php?c=returns&f=reply_request&r=1&id=<?= $return->getReturnId() ?>">Aceptar</a>
                        </td>
                        <td>
                            <a href="index.php?c=returns&f=reply_request&r=2&id=<?= $return->getReturnId() ?>">Rechazar</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<script src="assets/js/returnScript.js"></script>


<?php require_once FOOTER ?>