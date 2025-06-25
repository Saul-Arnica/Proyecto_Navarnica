<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Usuarios</h2>
        <a href="<?= base_url('gestion/altaUsuario') ?>" class="btn boton-custom">+ Agregar Usuario</a>
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
                        <a href="<?= base_url('gestion/editarUsuario?id_usuario=' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-warning">
                            Editar
                        </a>
                        <form action="<?= base_url('gestion/bajaUsuario/' . $usuario['id_usuario']) ?>" method="post" onsubmit="return confirm('¿Estás seguro?')" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>