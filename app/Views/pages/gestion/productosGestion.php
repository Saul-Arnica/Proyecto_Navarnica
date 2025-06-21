<?= $this->extend('gestion_layout') ?>
<?= $this->section('contenido') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Productos</h2>
    <a href="<?= base_url('admin/productos/nuevo') ?>" class="btn btn-primary">+ Agregar producto</a>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= esc($p['nombre']) ?></td>
                <td><?= esc($p['categoria']) ?></td>
                <td>$<?= number_format($p['precio'], 2) ?></td>
                <td><?= esc($p['stock']) ?></td>
                <td>
                    <a href="<?= base_url('admin/productos/editar/' . $p['id']) ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="<?= base_url('admin/productos/eliminar/' . $p['id']) ?>" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>