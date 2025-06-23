<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Consultas</h2>
    </div>

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
                        <a href="<?= base_url('gestion/eliminarConsulta/' . $consulta['id_consulta']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>