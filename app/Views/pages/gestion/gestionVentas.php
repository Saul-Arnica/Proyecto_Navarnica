<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-cart-check-fill me-2"></i> Historial de Ventas
        </h2>
    </div>
    <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->get('error')) ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->get('errors')): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session()->get('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->get('success')) ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->get('info')): ?>
                    <div class="alert alert-info">
                        <?= esc(session()->get('info')) ?>
                    </div>
                <?php endif; ?>


    <?php if (!empty($ventas)): ?>
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="text-center">#Venta</th>
                        <th>Usuario</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td class="text-center text-muted fw-bold">#<?= esc($venta['id_venta']) ?></td>
                            <td>
                                <i class="bi bi-person-circle me-1 text-secondary"></i>
                                <?= esc($venta['nombre_usuario']) ?>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark">
                                    <?= date('d/m/Y H:i', strtotime($venta['fecha_venta'])) ?>
                                </span>
                            </td>
                            <td class="text-end text-success fw-semibold">
                                $<?= number_format($venta['total'], 2, ',', '.') ?>
                            </td>
                            
                            <td class="text-center">
                                <a href="<?= base_url('gestion/detalleVenta/' . $venta['id_venta']) ?>" class="btn btn-sm btn-outline-info">
                                    Ver Detalle
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            No se encontraron ventas registradas.
        </div>
    <?php endif; ?>
</div>
































<!--<div>
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
                <th class="text-center">Productos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?= esc($venta['id_venta']) ?></td>
                    <td class="text-center"><?= esc($venta['nombre_usuario']) ?></td>
                    <td><?= esc($venta['fecha_venta']) ?></td>
                    <td class="text-center">$<?= number_format($venta['total'], 2, ',', '.') ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('gestion/detalleVenta/' . $venta['id_venta']) ?>" class="btn btn-sm btn-info">
                            Ver Detalle
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>-->