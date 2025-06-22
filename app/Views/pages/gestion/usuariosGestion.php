<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Usuarios</h2>
        <a href="<?= base_url('gestion/altaUsuario') ?>" class="btn boton-custom">+ Agregar Usuario</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="">Nombre y Apellido</th>
                <th class="text-center">Tipo de usuario</th>
                <th class="text-center">Dni</th>
                <th class="text-center">Email</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Direccion</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td class="text-center"><?= esc($usuario['nombre']) . ' ' . esc($usuario['apellido']) ?></td>
                    <td class="text-center"><?= esc($usuario['tipo_usuario']) ?></td>
                    <td class="text-center"><?= $usuario['dni'] ?></td>
                    <td class=""><?= $usuario['email'] ?></td>
                    <td class="text-center"><?= $usuario['telefono'] ?></td>
                    <td class="text-center"><?= $usuario['direccion'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('gestion/editarUsuario' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-warning text-white">Editar</a>
                        <a href="<?= base_url('gestion/eliminarUsuario' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>