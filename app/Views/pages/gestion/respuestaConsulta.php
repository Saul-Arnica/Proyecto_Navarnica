
<section>
    <h2> Responder consulta de <?= esc($consulta['nombre']) ?></h2>

    <p><strong>Asunto:</strong> <?= esc($consulta['asunto']) ?></p>
    <p><strong>Mensaje:</strong> <?= esc($consulta['mensaje']) ?></p>

    <form method="post" action="<?= base_url('/consulta/responder/' . $consulta['id_consulta']) ?>">
        <label for="respuesta">Respuesta:</label><br>
        <textarea name="respuesta" rows="6" style="width:100%" required></textarea><br><br>
        <button type="submit">Enviar respuesta</button>
    </form>

</section>