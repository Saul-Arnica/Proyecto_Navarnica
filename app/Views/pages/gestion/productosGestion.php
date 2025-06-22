<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Productos</h2>
        <a href="<?= base_url('gestion/altaProducto') ?>" class="btn boton-custom">+ Agregar producto</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Stock</th>
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
                    <td class="text-center">
                        <a href="<?= base_url('gestion/editarProducto' . $producto['id_producto']) ?>" class="btn btn-sm btn-warning text-white">Editar</a>
                        <a href="<?= base_url('gestion/eliminarProducto' . $producto['id_producto']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>