<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 rounded">

        <div class="row">
            <h1 class="text-center mt-3">Editar Producto</h1>

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

                <form action="<?= base_url('gestion/editarProducto') ?>" method="post" enctype="multipart/form-data" id="formularioEditarProducto">
                    <input type="hidden" name="id_producto" value="<?= esc($producto['id_producto']) ?>">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nombre" class="form-control" value="<?= esc($producto['nombre']) ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="marca" class="form-label">Marca</label>
                            <div class="input-group mb-3">
                                <input type="text" name="marca" class="form-control" value="<?= esc($producto['marca']) ?>">
                            </div>
                        </div>
                    </div>

                    <label for="descripcion" class="form-label">Descripción</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"><?= esc($producto['descripcion']) ?></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" name="precio" value="<?= esc($producto['precio']) ?>" step="0.01" min="0" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="stock" class="form-label">Stock</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="stock" value="<?= esc($producto['stock']) ?>" min="0" step="1">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="descuento" class="form-label">Descuento (%)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="descuento" value="<?= esc($producto['descuento']) ?>" min="0" max="100" step="1">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-3 col-md-4">
                            <label class="form-check-label" for="destacado">
                                Producto destacado
                            </label>
                            <input class="form-check-input" type="checkbox" id="destacado" name="destacado" value="1" <?= $producto['destacado'] ? 'checked' : '' ?>>
                        </div>
                            <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del producto</label>
                            <input type="file" name="imagenes[]" class="form-control" accept=".jpg,.jpeg,.png" multiple>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categorías</label>
                        <select class="form-select" id="categoria" name="id_categoria[]" multiple required>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= esc($categoria['id_categoria']) ?>" 
                                    <?= in_array($categoria['id_categoria'], $idsCategoriasAsignadas) ? 'selected' : '' ?>>
                                    <?= esc($categoria['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">Podés seleccionar una o más categorías (Ctrl + Click)</div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="btn boton-custom btn-sm" type="submit">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
