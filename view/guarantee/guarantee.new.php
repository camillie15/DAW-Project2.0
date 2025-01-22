<?php require_once HEADER; ?>

<main class="main-content">
    <h1 class="page-title">Formulario de Garantía</h1>
    <form action="index.php?c=guarantee&f=insert" method="post" class="form-guarantee">
        <div class="form-group">
            <label for="purchaseDate">Fecha de compra:</label>
            <input type="date" id="purchaseDate" name="purchaseDate" required />
        </div>

        <div class="form-group">
            <label for="warrantyReasonId">Razón de Garantía:</label>
            <select id="warrantyReasonId" name="warrantyReasonId" required>
                <option value="" disabled selected>Selecciona el motivo</option>
                <?php foreach ($guaranteeReasons as $reason) { ?>
                    <option value="<?php echo $reason['warrantyReasonId']; ?>"><?php echo htmlspecialchars($reason['description']); ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="productCode">Código del producto:</label>
            <input type="text" id="productCode" name="productCode" required />
        </div>

        <div class="form-group">
            <label for="invoiceCode">Código de factura:</label>
            <input type="text" id="invoiceCode" name="invoiceCode" required />
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        
        <div style="display: flex; justify-content: center;">
            <button style="align-items: center;" type="submit" class="btn-guarantee">Enviar</button>
        </div>
    </form>
</main>

<?php require_once FOOTER; ?>
