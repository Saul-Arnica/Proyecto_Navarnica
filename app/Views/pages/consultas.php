<section>
    <h1>CONSULTAs</h1>
    <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h2>Formulario de Contacto</h2>
                    <form action="<?= base_url('contacto/enviar') ?>" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
</section>