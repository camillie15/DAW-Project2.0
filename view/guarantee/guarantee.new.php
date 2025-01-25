<?php require_once HEADER; 
    $maxDate = date('Y-m-d');
    $minDate = date('Y-m-d', strtotime('-1 year'));
    // autor: Cesar Alexander Tipan Anton
?>

<main class="main-content guarantee-main">
    <h1 class="page-title">Formulario de Garantía</h1>
    <form action="index.php?c=guarantee&f=insert" method="post" class="form-guarantee">
        <div class="form-group-guarantee">
            <label for="purchaseDate">Fecha de compra: <span style="color: #f04;">*</span></label>
            <input type="date" id="purchaseDate" name="purchaseDate" min="<?php echo $minDate; ?>" max="<?php echo $maxDate; ?>"
                value="<?php echo isset($formData['purchaseDate']) ? htmlspecialchars($formData['purchaseDate']) : ''; ?>"
                required />
        </div>

        <div class="form-group-guarantee">
            <label for="warrantyReasonId">Razón de Garantía: <span style="color: #f04;">*</span></label>
            <select id="warrantyReasonId" name="warrantyReasonId" required>
                <option value="" disabled <?php echo empty($formData['warrantyReasonId']) ? 'selected' : ''; ?>>Selecciona el motivo</option>
                <?php foreach ($guaranteeReasons as $reason) { ?>
                    <option value="<?php echo $reason['warrantyReasonId']; ?>" 
                            <?php echo isset($formData['warrantyReasonId']) && $formData['warrantyReasonId'] == $reason['warrantyReasonId'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($reason['description']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group-guarantee">
            <label for="productCode">Código del producto: <span style="color: #f04;">*</span></label>
            <input type="text" id="productCode" name="productCode" placeholder="PRXXXXXXXXXXXX" minlength="13" maxlength="13"
                value="<?php echo isset($formData['productCode']) ? htmlspecialchars($formData['productCode']) : ''; ?>" required/>
            <?php if (isset($error) && in_array("El código del producto es requerido.", $error)) { ?>
                <p class="error-msg-guarantee">El código del producto es requerido.</p>
            <?php } ?>
        </div>

        <div class="form-group-guarantee">
            <label for="invoiceCode">Código de factura: <span style="color: #f04;">*</span></label>
            <input type="text" id="invoiceCode" name="invoiceCode" placeholder="FAXXXXXXXXXXXX" minlength="13" maxlength="13"
                value="<?php echo isset($formData['invoiceCode']) ? htmlspecialchars($formData['invoiceCode']) : ''; ?>" required />
            <?php if (isset($error) && in_array("El código de factura es requerido.", $error)) { ?>
                <p class="error-msg-guarantee">El código de factura es requerido.</p>
            <?php } ?>
        </div>

        <div class="form-group-guarantee">
            <label for="description">Descripción: <span style="color: #f04;">*</span></label>
            <textarea id="description" name="description" rows="4" required placeholder="Detallar la descripción aquí" maxlength="250"><?php echo isset($formData['description']) ? htmlspecialchars($formData['description']) : ''; ?></textarea>
            <?php if (isset($error) && in_array("La descripción es requerida.", $error)) { ?>
                <p class="error-msg-guarantee">La descripción es requerida.</p>
            <?php } ?>
        </div>

        <div style="display: flex; justify-content: center; width: fit-content; margin: auto">
            <button style="align-items: center;" type="submit" class="btn-guarantee">Enviar</button>
        </div>
    </form>
</main>

<?php require_once FOOTER; ?>