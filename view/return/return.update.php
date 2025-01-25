<?php require_once HEADER 
// autor: Erick Alejandro Cordova Viteri
?>

<main class="container-requirements-return">
    <section class="container-form-return">
        <?php if (isset($_GET['message'])): ?>
            <p style="color:#d04; font-weight: bold; font-size: 1.2rem;">
                <?= $_GET['message'] ?>
            </p>
        <?php endif; ?>
        <form class="form-return" action="index.php?c=returns&f=update_return&id=<?= $returnId ?>" method="post">
            <h2 class="title-return">Actualizar peticion de devolución</h2>
            <div>
                <label for="purchase_date">Fecha compra producto <span style="color: #f04;">*</span></label>
                <input type="date" name="purchase_date" value="<?= $return->getPurchaseDate() ?>" required>
            </div>
            <div>
                <label for="product_status">Estado del producto</label>
                <select name="product_status">
                    <option value="Cerrado">Cerrado</option>
                    <option value="Abierto">Abierto</option>
                </select>
            </div>
            <div>
                <label for="product_code">Código del producto <span style="color: #f04;">*</span></label>
                <input type="text" name="product_code" value="<?= $return->getProductCode() ?>" minlength="13" maxlength="13" required>
            </div>
            <div>
                <label for="invoice_code">Código de la factura</label>
                <input type="text" name="invoice_code" value="<?= $return->getInvoiceCode() ?>" minlength="13" maxlength="13" required>
            </div>
            <div>
                <label for="description">Descripción a detalle del problema</label>
                <textarea name="description" id="description" maxlength="250" required><?= $return->getDescription() ?></textarea>
            </div>
            <div class="container-btn">
                <button class="btn-return st-btn-two">Actualizar peticion</button>
            </div>
        </form>
    </section>
</main>

<script src="assets/js/returnScript.js"></script>


<?php require_once FOOTER ?>