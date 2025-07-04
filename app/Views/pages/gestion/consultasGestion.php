<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Consultas</h2>
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
                <th class="text-center">Nombre</th>
                <th class="text-center">Email</th>
                <th class="text-center">Asunto</th>
                <th class="text-center">Mensaje</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td class="text-center"><?= esc($consulta['nombre']) ?></td>
                    <td class="text-center"><?= esc($consulta['email']) ?></td>
                    <td class="text-center"><?= esc($consulta['asunto']) ?></td>
                    <td class=""><?= $consulta['mensaje'] ?></td>
                    <td class="text-center"><?= $consulta['estado'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('gestion/responderConsulta/' . $consulta['id_consulta']) ?>" class="btn btn-sm btn-warning text-white">Responder</a>
                        <form action="<?= base_url('gestion/eliminarConsulta/' . $consulta['id_consulta']) ?>" method="post" onsubmit="return confirm('¿Estás seguro?')" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>