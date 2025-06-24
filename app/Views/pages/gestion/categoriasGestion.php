<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categorias</h2>
        <a href="<?= base_url('gestion/altaCategoria') ?>" class="btn boton-custom">+ Agregar categoria</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripcion</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td class="text-center"><?= esc($categoria['nombre']) ?></td>
                    <td class=""><?= $categoria['descripcion'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('gestion/editarCategoria/' . $categoria['id_categoria']) ?>" class="btn btn-sm btn-warning text-white">Editar</a>
                        <form action="<?= base_url('gestion/eliminarCategoria/' . $categoria['id_categoria']) ?>" method="post" onsubmit="return confirm('¿Estás seguro?')" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>