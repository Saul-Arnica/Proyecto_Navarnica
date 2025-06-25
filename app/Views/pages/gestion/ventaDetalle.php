<div class="container my-4">
    <div class="mb-4">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-receipt-cutoff me-2"></i> Detalle de Venta #<?= esc($venta['id_venta']) ?>
        </h2>
        <p class="text-muted mb-1">
            <i class="bi bi-calendar-event me-1"></i> 
            Fecha: <span class="badge bg-light text-dark"><?= date('d/m/Y H:i', strtotime($venta['fecha_venta'])) ?></span>
        </p>
        <p class="text-muted">
            <i class="bi bi-cash-coin me-1"></i> 
            Total: <span class="fw-semibold text-success">$<?= number_format($venta['total'], 2, ',', '.') ?></span>
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold bg-navarnica">
            <i class="bi bi-box-seam me-2"></i> Productos vendidos
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead style="background-color: #3b9c9c; color: white;">
                    <tr>
                        <th>Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-end">Precio Unitario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td><?= esc($detalle['nombre_producto']) ?></td>
                            <td class="text-center"><?= esc($detalle['cantidad']) ?></td>
                            <td class="text-end text-success">
                                $<?= number_format($detalle['precio_unitario'], 2, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <a href="<?= base_url('gestion/ventas') ?>" class="btn btn-outline-secondary mt-4">
        <i class="bi bi-arrow-left-circle me-1"></i> Volver al Historial de Ventas
    </a>
</div>
