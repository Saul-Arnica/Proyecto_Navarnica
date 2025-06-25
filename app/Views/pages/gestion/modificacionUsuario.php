<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 rounded">

        <div class="row">
            <h1 class="text-center mt-3">Modificación de Usuario</h1>

            <div class="col-sm-10 col-md-12 mt-3">
                <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->get('error')) ?>
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
                <form action="<?= base_url('gestion/modificarUsuario/' . $usuario['id_usuario']) ?>" method="post" id="formularioModificacionUsuario">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                                    aria-label="Nombre" value="<?= old('nombre', esc($usuario['nombre'])) ?>" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <div class="input-group mb-3">
                                <input type="text" name="apellido" class="form-control" placeholder="Apellido"
                                    value="<?= old('apellido', esc($usuario['apellido'])) ?>">
                            </div>
                        </div>
                    </div>

                    <label for="email" class="form-label">Email</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= old('email', esc($usuario['email'])) ?>" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">DNI</span>
                        <input type="text" class="form-control" id="dni" name="dni"
                            value="<?= old('dni', esc($usuario['dni'])) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="password" class="form-label">Contraseña (dejar en blanco para no modificar)</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    value="<?= old('telefono', esc($usuario['telefono'])) ?>" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="tipo_usuario" class="form-label">Tipo de usuario</label>
                            <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                                <option value="">Seleccionar tipo de usuario</option>
                                <option value="admin" <?= old('tipo_usuario', $usuario['tipo_usuario']) === 'admin' ? 'selected' : '' ?>>Administrador</option>
                                <option value="cliente" <?= old('tipo_usuario', $usuario['tipo_usuario']) === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button class="btn boton-custom btn-sm" type="submit">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
