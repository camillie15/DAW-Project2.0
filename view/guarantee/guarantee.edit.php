<!-- autor: Tipan Anton Cesar Alexander -->
<?php require_once HEADER;  
    $maxDate = date('Y-m-d');
    $minDate = date('Y-m-d', strtotime('-1 year'));
?>

<main class="main-content guarantee-main">
    <h2 class="page-title">Editar Solicitud de Garantía</h2>

    <?php if (isset($errorMessage)) { ?>
        <div class="error-message">
            <p><?php echo $errorMessage; ?></p>
        </div>
    <?php } ?>

    <form action="index.php?c=guarantee&f=update" method="POST" class="form">
        <input type="hidden" name="guaranteeId" value="<?php echo $guarantee['guaranteeId']; ?>" />

        <div class="form-group">
            <label for="purchaseDate">Fecha de la Compra: <span style="color: #f04;">*</span></label>
            <input type="date" id="purchaseDate" name="purchaseDate" min="<?php echo $minDate; ?>" max="<?php echo $maxDate; ?>"
                value="<?php echo isset($formData['purchaseDate']) ? htmlspecialchars($formData['purchaseDate']) : date('Y-m-d', strtotime($guarantee['purchaseDate'])); ?>" required />
        </div>

        <div class="form-group">
            <label for="warrantyReasonId">Razón de Garantía: <span style="color: #f04;">*</span></label>
            <select id="warrantyReasonId" name="warrantyReasonId" required>
                <option value="" disabled <?php echo empty($formData['warrantyReasonId']) ? 'selected' : ''; ?>>Selecciona el motivo</option>
                <?php foreach ($guaranteeReasons as $reason) { ?>
                    <option value="<?php echo $reason['warrantyReasonId']; ?>"
                            <?php echo isset($formData['warrantyReasonId']) && $formData['warrantyReasonId'] == $reason['warrantyReasonId'] 
                                    || $guarantee['warrantyReasonId'] == $reason['warrantyReasonId'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($reason['description']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="productCode">Código del Producto: <span style="color: #f04;">*</span></label>
            <input type="text" id="productCode" name="productCode" placeholder="PRXXXXXXXXXXXX" minlength="13" maxlength="13"
                value="<?php echo isset($formData['productCode']) ? htmlspecialchars($formData['productCode']) : htmlspecialchars($guarantee['productCode']); ?>" required />
            <?php if (isset($error) && in_array("El código del producto es requerido.", $error)) { ?>
                <p class="error-msg-guarantee">El código del producto es requerido.</p>
            <?php } ?>
        </div>

        <div class="form-group">
            <label for="invoiceCode">Código de Factura: <span style="color: #f04;">*</span></label>
            <input type="text" id="invoiceCode" name="invoiceCode" placeholder="FAXXXXXXXXXXXX" minlength="13" maxlength="13"
                value="<?php echo isset($formData['invoiceCode']) ? htmlspecialchars($formData['invoiceCode']) : htmlspecialchars($guarantee['invoiceCode']); ?>" required />
            <?php if (isset($error) && in_array("El código de factura es requerido.", $error)) { ?>
                <p class="error-msg-guarantee">El código de factura es requerido.</p>
            <?php } ?>
        </div>

        <div class="form-group">
            <label for="description">Descripción: <span style="color: #f04;">*</span></label>
            <textarea id="description" name="description" rows="4" required placeholder="Detallar la descripción aquí" maxlength="250"><?php echo isset($formData['description']) ? htmlspecialchars($formData['description']) : htmlspecialchars($guarantee['description']); ?></textarea>
            <?php if (isset($error) && in_array("La descripción es requerida.", $error)) { ?>
                <p class="error-msg-guarantee">La descripción es requerida.</p>
            <?php } ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-guarantee">Guardar Cambios</button>
            <a href="index.php?c=guarantee&f=listGuarantees" class="btn btn-guarantee">Cancelar</a>
        </div>
    </form>
</main>

<?php require_once FOOTER; ?>
