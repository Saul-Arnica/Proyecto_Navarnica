<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Productos</h2>
    </div>
    <div class="row">
        <div class="col">
            <form method="get" class="row g-3 mb-4">
                <div class="col-auto">
                    <select name="stock" class="form-select">
                        <option value="">-- Stock --</option>
                        <option value="1" <?= (isset($_GET['stock']) && $_GET['stock'] === '1') ? 'selected' : '' ?>>En stock</option>
                        <option value="0" <?= (isset($_GET['stock']) && $_GET['stock'] === '0') ? 'selected' : '' ?>>Sin stock</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="activo" class="form-select">
                        <option value="">-- Estado --</option>
                        <option value="1" <?= (isset($_GET['activo']) && $_GET['activo'] === '1') ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= (isset($_GET['activo']) && $_GET['activo'] === '0') ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn boton-custom">Filtrar</button>
                    <a href="<?= base_url('gestion/productos') ?>" class="btn btn-secondary">Limpiar</a>
                </div>
            </form>
        </div>
        <div class="col text-end">
            <a href="<?= base_url('gestion/altaProducto') ?>" class="btn boton-custom">+ Agregar producto</a>
        </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= esc($producto['nombre']) ?></td>
                    <td class="text-center"><?= esc($producto['marca']) ?></td>
                    <td class=""><?= $producto['descripcion'] ?></td>
                    <td class="text-center">$<?= number_format($producto['precio'], 2, ',', '.') ?></td>
                    <td class="text-center"><?= esc($producto['stock']) ?></td>
                    <td class="text-center"><?= $producto['activo'] ? 'Activo' : 'Inactivo' ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('gestion/editarProducto?id_producto=' . $producto['id_producto']) ?>" class="btn btn-sm btn-warning">
                            Editar
                        </a>
                        <form action="<?= base_url('gestion/bajaProducto/' . $producto['id_producto']) ?>" method="post" onsubmit="return confirm('¿Estás seguro?')" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>