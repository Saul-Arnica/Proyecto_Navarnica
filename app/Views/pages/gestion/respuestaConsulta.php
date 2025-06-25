
<section class="container py-4">
    <h2> Responder consulta de <?= esc($consulta['nombre']) ?></h2>
    <p><strong>Asunto:</strong> <?= esc($consulta['asunto']) ?></p>
    <p><strong>Mensaje:</strong> <?= esc($consulta['mensaje']) ?></p>
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
    <form method="post" action="<?= base_url('gestion/responderConsulta/' . $consulta['id_consulta']) ?>">
        <label for="respuesta">Respuesta:</label><br>
        <textarea name="respuesta" rows="6" style="width:100%" required></textarea><br><br>
        <button class="btn btn-primary" type="submit">Enviar respuesta</button>
    </form>

</section>