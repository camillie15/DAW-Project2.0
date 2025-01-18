<?php require_once HEADER ?>

<body>
    <h1>
        VISTA ESTATICA PARA LAS DEVOLUCIONES
    </h1>
    <?php if (isset($_GET['message'])): ?>
        <h2>
            <?= $_GET['message'] ?>
        </h2>
    <?php endif; ?>
    <a href="index.php?c=returns&f=insert_view">Pedir una devolución</a>
    <a href="index.php?c=returns&f=list_client_view">Historial de mis peticiones</a>
    <h2>Requisitos para pedir una devolucion</h2>
    <section>
        <ul>
            <li>El producto debe estar en perfectas condiciones</li>
            <li>El producto debe estar en perfectas condiciones</li>
            <li>El producto debe tener la etiqueta</li>
            <li>El producto debe tener la factura</li>
        </ul>
    </section>
</body>

<script src="assets/js/returnScript.js"></script>

<?php require_once FOOTER ?>