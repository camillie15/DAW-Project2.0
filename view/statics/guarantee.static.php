<!-- autor: Tipan Anton Cesar Alexander -->
<?php require_once HEADER; ?>

<main class="main-content">
    <section class="container-rules-guarantee">
        <h2 class="page-title" style="color: #2f32ec">SOLICITUD DE GARANTÍA</h2>
        <h3 class="guarantee-subtitle">Requisitos para solicitar una garantía</h3>
        <p style="margin: 0px;">Antes de realizar la solicitud de garantía de su producto, tenga en cuenta los siguientes requisitos:</p>
        <ul>
            <li>El producto debe estar dentro del período de garantía especificado al momento de la compra.</li>
            <li>Debe presentar defectos de fabricación, problemas de funcionamiento, averías mecánicas, eléctricas o electrónicas, desgaste irregular de piezas o errores de ensamblaje.</li>
            <li>Es indispensable adjuntar la factura o comprobante de compra.</li>
            <li>Si el producto fue manipulado o reparado por terceros no autorizados, la garantía podría no ser válida.</li>
            <li>Asegúrese de proporcionar una descripción detallada del problema en el formulario de garantía.</li>
        </ul>
        <h4>Nota: El cumplimiento de estos requisitos es fundamental para que su solicitud sea evaluada correctamente.</h4>
        <div style="display: flex; justify-content: center; gap: 1rem;">
            <a href="index.php?c=guarantee&f=insertForm" class="btn-guarantee">Crear solicitud de garantía</a>
            <a href="index.php?c=guarantee&f=listGuarantees" class="btn-guarantee">Ver solicitudes</a>
        </div>
    </section>
</main>

<?php require_once FOOTER; ?>
