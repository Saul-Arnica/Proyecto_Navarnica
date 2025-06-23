<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 rounded">

        <div class="row">
            <h1 class="text-center mt-3">Alta de producto</h1>
            
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

                <form action="<?= base_url('gestion/altaProducto') ?>" method="post" id="formularioAltaProducto">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                                    aria-label="Nombre" aria-describedby="Nombre" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="marca" class="form-label">Marca</label>
                            <div class="input-group mb-3">
                                <input type="text" name="marca" class="form-control" placeholder="Marca"
                                    aria-label="Marca" aria-describedby="Marca">
                            </div>
                        </div>
                    </div>
                    <label for="descripcion" class="form-label">Descripción</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Escribí una descripción..."></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" placeholder="0.00" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="stock" class="form-label">Stock</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="stock" name="stock" min="0" step="1" placeholder="0">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="descuento" class="form-label">Descuento (%)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="descuento" name="descuento" min="0" max="100" step="1" placeholder="0">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-3 col-md-4">
                            <label class="form-check-label" for="destacado">
                                Producto destacado
                            </label>
                            <input class="form-check-input" type="checkbox" id="destacado" name="destacado" value="1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select class="form-select" id="categoria" name="id_categoria" required>
                            <option value="">Seleccionar categoría</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= esc($categoria['id_categoria']) ?>">
                                    <?= esc($categoria['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn boton-custom btn-sm" type="submit">
                            Agregar producto
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>