<?php require_once HEADER; ?>
<h1>Formulario de Garantía</h1>
<form action="index.php?c=guarantee&f=insert" method="post">
    <div>
        <label for="purchaseDate">Fecha de compra</label>
        <input type="date" id="purchaseDate" name="purchaseDate" required>
    </div>

    <div>
        <label for="warrantyReasonId">Razón de Garantía</label>
        <div>
            <select name="warrantyReasonId" id="warrantyReasonId" required>
                <option value="" disabled selected>Selecciona el motivo</option>
                <?php foreach ($guaranteeReasons as $guaranteeReason) { ?>
                    <option value="<?php echo htmlspecialchars($guaranteeReason['warrantyReasonId']); ?>">
                        <?php echo htmlspecialchars($guaranteeReason['description']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div>
        <label for="productCode">Codigo de producto</label>
        <input type="text" id="productCode" name="productCode" placeholder="Ingresar codigo de producto" required>
    </div>

    <div>
        <label for="invoiceCode">Codigo de factura</label>
        <input type="text" id="invoiceCode" name="invoiceCode" placeholder="Ingresar codigo de factura" required>
    </div>

    <div>
        <label for="description">Descripcion</label>
        <textarea id="description" name="description" rows="4" placeholder="Ingresar detalle de la solicitud" required></textarea>
    </div>

    <button type="submit">Solicitar</button>
</form>
<?php require_once FOOTER; ?>