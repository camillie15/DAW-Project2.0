<?php require_once HEADER ?>

<main>
    <?php if (isset($_GET['message'])): ?>
        <h2>
            <?= $_GET['message'] ?>
        </h2>
    <?php endif; ?>
    <form action="index.php?c=returns&f=insert_new_return" method="post">
        <h1>Insertar datos del reclamos de devoluciones</h1>
        <div>
            <label for="purchase_date">Fecha compra producto</label>
            <input type="date" name="purchase_date">
        </div>
        <div>
            <label for="product_status">Estado del producto</label>
            <select name="product_status">
                <option value="Cerrado">Cerrado</option>
                <option value="Abierto">Abierto</option>
            </select>
        </div>
        <div>
            <label for="product_code">Codigo del producto</label>
            <input type="text" name="product_code">
        </div>
        <div>
            <label for="invoice_code">Codigo de la factura</label>
            <input type="text" name="invoice_code">
        </div>
        <div>
            <label for="description">Descripcion a detalle del problema</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <p>...</p>
        <button>Insertar test</button>
    </form>
</main>

<script src="assets/js/returnScript.js"></script>


<?php require_once FOOTER ?>