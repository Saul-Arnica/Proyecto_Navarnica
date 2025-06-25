<div class="row justify-content-center">
    <div>
        <a href="<?= previous_url() ?>" class="btn btn-dark">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
    <div class="col-sm-8 col-md-6 rounded">
        <div class="row">
            <h1 class="text-center mt-3">Alta de Categoria</h1>
            <div class="col-sm-10 col-md-12 mt-3">
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


                <form action="<?= base_url('gestion/modificarCategoria/' . $categoria['id_categoria']) ?>" method="post">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                                    aria-label="Nombre" aria-describedby="Nombre" 
                                    value="<?= old('nombre', isset($categoria) ? esc($categoria['nombre']) : '') ?>" required>
                            </div>
                        </div>
                        <label for="descripcion" class="form-label">Descripción</label>
                        <div class="input-group mb-3">
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Escribí una descripción..."><?= old('descripcion', isset($categoria) ? esc($categoria['descripcion']) : '') ?></textarea>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn boton-custom btn-sm" type="submit">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>