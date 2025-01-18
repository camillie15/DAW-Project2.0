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
    <a href="index.php?c=returns&f=insert_view">Insertar peticion de devolucion</a>
</body>

<script src="assets/js/returnScript.js"></script>

<?php require_once FOOTER ?>