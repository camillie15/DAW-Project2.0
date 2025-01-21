<?php require_once HEADER; ?>

<main>
    <h2>Editar Solicitud de Garantía</h2>

    <?php if (isset($errorMessage)) { ?>
        <div class="error">
            <p><?php echo $errorMessage; ?></p>
        </div>
    <?php } ?>

    <form action="index.php?c=guarantee&f=update" method="POST">
        <input type="hidden" name="guaranteeId" value="<?php echo $guarantee['guaranteeId']; ?>" />

        <div>
            <label for="purchaseDate">Fecha de la Compra (dd/mm/yyyy):</label>
            <input type="date" id="purchaseDate" name="purchaseDate"
                value="<?php echo date('Y-m-d', strtotime($guarantee['purchaseDate'])); ?>" required />
        </div>

        <div>
            <label for="warrantyReasonId">Razón de Garantía:</label>
            <select id="warrantyReasonId" name="warrantyReasonId" required>
                <option value="1" <?php echo ($guarantee['warrantyReasonId'] == 1) ? 'selected' : ''; ?>>Defectos de
                    fabricación</option>
                <option value="2" <?php echo ($guarantee['warrantyReasonId'] == 2) ? 'selected' : ''; ?>>Problemas de
                    funcionamiento</option>
                <option value="3" <?php echo ($guarantee['warrantyReasonId'] == 3) ? 'selected' : ''; ?>>Averías
                    mecánicas, eléctricas o electrónicas</option>
                <option value="4" <?php echo ($guarantee['warrantyReasonId'] == 4) ? 'selected' : ''; ?>>Desgaste
                    irregular de piezas</option>
                <option value="5" <?php echo ($guarantee['warrantyReasonId'] == 5) ? 'selected' : ''; ?>>Error de
                    ensamblaje</option>
            </select>
        </div>

        <div>
            <label for="productCode">Código del Producto:</label>
            <input type="text" id="productCode" name="productCode" value="<?php echo $guarantee['productCode']; ?>"
                required />
        </div>

        <div>
            <label for="invoiceCode">Código de Factura:</label>
            <input type="text" id="invoiceCode" name="invoiceCode" value="<?php echo $guarantee['invoiceCode']; ?>"
                required />
        </div>

        <div>
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" required><?php echo $guarantee['description']; ?></textarea>
        </div>

        <div>
            <button type="submit">Guardar Cambios</button>
            <a href="index.php?c=guarantee&f=listGuarantees">Cancelar</a>
        </div>
    </form>
</main>

<?php require_once FOOTER; ?>
