<?php require_once HEADER; ?>

<main class="main-content">
    <h2 class="page-title">Editar Solicitud de Garantía</h2>

    <?php if (isset($errorMessage)) { ?>
        <div class="error-message">
            <p><?php echo $errorMessage; ?></p>
        </div>
    <?php } ?>

    <form action="index.php?c=guarantee&f=update" method="POST" class="form">
        <input type="hidden" name="guaranteeId" value="<?php echo $guarantee['guaranteeId']; ?>" />

        <div class="form-group">
            <label for="purchaseDate">Fecha de la Compra (dd/mm/yyyy):</label>
            <input type="date" id="purchaseDate" name="purchaseDate"
                value="<?php echo date('Y-m-d', strtotime($guarantee['purchaseDate'])); ?>" required />
        </div>

        <div class="form-group">
            <label for="warrantyReasonId">Razón de Garantía:</label>
            <select id="warrantyReasonId" name="warrantyReasonId" required>
                <option value="1" <?php echo ($guarantee['warrantyReasonId'] == 1) ? 'selected' : ''; ?>>Defectos de fabricación</option>
                <option value="2" <?php echo ($guarantee['warrantyReasonId'] == 2) ? 'selected' : ''; ?>>Problemas de funcionamiento</option>
                <option value="3" <?php echo ($guarantee['warrantyReasonId'] == 3) ? 'selected' : ''; ?>>Averías mecánicas, eléctricas o electrónicas</option>
                <option value="4" <?php echo ($guarantee['warrantyReasonId'] == 4) ? 'selected' : ''; ?>>Desgaste irregular de piezas</option>
                <option value="5" <?php echo ($guarantee['warrantyReasonId'] == 5) ? 'selected' : ''; ?>>Error de ensamblaje</option>
            </select>
        </div>

        <div class="form-group">
            <label for="productCode">Código del Producto:</label>
            <input type="text" id="productCode" name="productCode" value="<?php echo $guarantee['productCode']; ?>" required />
        </div>

        <div class="form-group">
            <label for="invoiceCode">Código de Factura:</label>
            <input type="text" id="invoiceCode" name="invoiceCode" value="<?php echo $guarantee['invoiceCode']; ?>" required />
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required><?php echo $guarantee['description']; ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-guarantee">Guardar Cambios</button>
            <a href="index.php?c=guarantee&f=listGuarantees" class="btn btn-guarantee">Cancelar</a>
        </div>
    </form>
</main>

<?php require_once FOOTER; ?>
