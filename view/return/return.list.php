<?php require_once HEADER 
// autor: Erick Alejandro Cordova Viteri
?>

<main class="container-requirements-return">
    <section class="container-list-return">
        <h1 class="title-return"><?= $title ?></h1>
        <?php if (isset($_GET['message'])): ?>
            <p style="color:#0c4; font-weight: bold; font-size: 1.2rem;">
                <?= $_GET['message'] ?>
        </p>
        <?php endif; ?>
        <div class="container-table-return">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Estado de la solicitud</th>
                        <th scope="col">Fecha de solicitud</th>
                        <th scope="col">Fecha de compra</th>
                        <th scope="col">Estado del producto</th>
                        <th scope="col">Codigo del producto</th>
                        <th scope="col">Codigo de la factura</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($returns as $return): ?>
                        <tr class="body-row">
                            <td class="request-status" scope="row">
                                <?php if ($return->getRequestStatus() == 0): ?>
                                    <span style="border: 2px solid #DDD;">Pendiente</span>
                                <?php endif; ?>
                                <?php if ($return->getRequestStatus() == 1): ?>
                                    <span style="border: 2px solid #0f4;">Aprobado</span>
                                <?php endif; ?>
                                <?php if ($return->getRequestStatus() == 2): ?>
                                    <span style="border: 2px solid #f74;">Rechazado</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size: 0.9rem;" scope="row">
                                <?= $return->getRequestDate() ?>
                            </td>
                            <td style="font-size: 0.9rem;" scope="row">
                                <?= $return->getPurchaseDate() ?>
                            </td>
                            <td scope="row">
                                <strong><?= $return->getProductStatus() ?></strong>
                            </td>
                            <td style="font-size: 0.9rem;" scope="row">
                                <?= $return->getProductCode() ?>
                            </td>
                            <td style="font-size: 0.9rem;" scope="row">
                                <?= $return->getInvoiceCode() ?>
                            </td>
                            <td style="font-size: 0.9rem;" scope="row" class="hidden-col">
                                <?= $return->getDescription() ?>
                            </td>
                            <?php if ($_GET['f'] == "list_client_view"): ?>
                                <td scope="row">
                                    <strong><a style="color:#0c4;" href="index.php?c=returns&f=update_view&id=<?= $return->getReturnId() ?>">Editar</a></strong>
                                </td>
                                <td scope="row">
                                    <strong><a style="color:#c04;" href="index.php?c=returns&f=delete_return&id=<?= $return->getReturnId() ?>">Eliminar</a></strong>
                                </td>
                            <?php endif; ?>
                            <?php if ($_GET['f'] == "list_view"): ?>
                                <td scope="row">
                                    <strong><a style="color:#0c4;" href="index.php?c=returns&f=reply_request&r=1&id=<?= $return->getReturnId() ?>">Aceptar</a></strong>
                                </td>
                                <td scope="row">
                                    <strong><a style="color:#c04;" href="index.php?c=returns&f=reply_request&r=2&id=<?= $return->getReturnId() ?>">Rechazar</a></strong>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<script src="assets/js/returnScript.js"></script>


<?php require_once FOOTER ?>