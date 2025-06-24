<section class="container py-5">
    <h2 class="text-center mb-4">Mis Compras</h2>

    <?php if (empty($ventas)): ?>
        <p>No has realizado compras aún.</p>
    <?php else: ?>
        <?php foreach ($ventas as $venta): ?>
            <div class="card mb-3">
                <div class="card-header">
                    Venta #<?= $venta['id_venta'] ?> - <?= $venta['fecha_venta'] ?> - Total: $<?= number_format($venta['total'], 2) ?>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($venta['detalles'] as $detalle): ?>
                            <li class="list-group-item">
                                Producto: <?= esc($detalle['nombre_producto']) ?> |
                                Cantidad: <?= $detalle['cantidad'] ?> |
                                Precio unitario: $<?= number_format($detalle['precio_unitario'], 2) ?> |
                                Subtotal: $<?= number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>