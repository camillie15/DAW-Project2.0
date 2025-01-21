<?php require_once HEADER; ?>
<main>
    <h2>Lista de solicitudes de garantia</h2>
    <a href="index.php?c=guarantee&f=insertForm">Crear solicitud de garantia</a>
    <table>
        <thead>
            <tr>
                <th>Fecha de la compra</th>
                <th>Razon de garantia</th>
                <th>Codigo del producto</th>
                <th>Codigo de factura</th>
                <th>Descripcion</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($guarantees)) { ?>
                <tr>
                    <td colspan="6">No hay solicitudes de garantia</td>
                </tr>
            <?php }else{ ?>
                <?php foreach ($guarantees as $guarantee) { ?>
                    <tr>
                        <td><?php echo $guarantee['purchaseDate']; ?></td>
                        <td>
                            <?php
                            switch($guarantee['warrantyReasonId']){
                                case 1: echo "Defectos de fabricacion"; break;
                                case 2: echo "Problemas de funcionamiento"; break;
                                case 3: echo "Averias mecanicas"; break;
                            }?>
                        </td>
                        <td><?php echo $guarantee['productCode']; ?></td>
                        <td><?php echo $guarantee['invoiceCode']; ?></td>
                        <td><?php echo $guarantee['description']; ?></td>
                        <td><?php echo $guarantee['requestStatus']; ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php require_once HEADER; ?>