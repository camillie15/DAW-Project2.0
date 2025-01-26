<!-- autor: Cordova Viteri Erick Alejandro  -->
<?php require_once HEADER ?>

<main class="container-requirements-return">
    <section class="container-rules-return">
        <h2 class="title-return">DEVOLUCIÓN DE PRODUCTOS</h2>
        <h3 class="subtitle-return">Requisitos para pedir una devolucion</h3>
        <p>Antes de solicitar la devolución de su producto, tenga en cuenta los siguientes requisitos:</p>
        <ul class="list-requirements">
            <li>El producto debe encontrarse en perfectas condiciones, sin señales de uso o daño.</li>
            <li>El producto debe haber sido comprado dentro del último mes.</li>
            <li>La etiqueta original debe estar intacta y adherida al producto.</li>
            <li>Es indispensable presentar la factura o comprobante de compra.</li>
        </ul>
    </section>
    <section class="container-btn">
        <a href="index.php?c=returns&f=insert_view" class="btn-return st-btn-one">Pedir una devolución</a>
        <a href="index.php?c=returns&f=list_client_view" class="btn-return st-btn-two">Historial de mis peticiones</a>
    </section>
    <?php if (isset($_GET['message'])): ?>
        <p style="color: #0c4; font-weight: bold; font-size: 1.2rem;" class="message"><?= $_GET['message'] ?></p>
    <?php endif; ?>
</main>

<script src="assets/js/returnScript.js"></script>

<?php require_once FOOTER ?>