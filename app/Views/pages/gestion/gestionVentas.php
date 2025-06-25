<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ventas</h2>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">ID Venta</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Total</th>
                <!--<th class="text-center">Productos</th>-->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?= esc($venta['id_venta']) ?></td>
                    <td class="text-center"><?= esc($venta['nombre_usuario']) ?></td>
                    <td><?= esc($venta['fecha_venta']) ?></td>
                    <td class="text-center">$<?= number_format($venta['total'], 2, ',', '.') ?></td>
                    <!--<td class="text-center">
                        <a href="<?= base_url('gestion/detalleVenta/' . $venta['id_venta']) ?>" class="btn btn-sm btn-info">
                            Ver Detalle
                        </a>-->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>