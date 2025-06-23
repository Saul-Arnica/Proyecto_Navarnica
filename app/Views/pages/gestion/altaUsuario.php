<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 rounded">


        <div class="row">
            <h1 class="text-center mt-3">Alta de Usuario</h1>
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

                <form action="<?= base_url('gestion/altaUsuario') ?>" method="post" id="formularioAltaUsuario">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                                    aria-label="Nombre" aria-describedby="Nombre" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="apellido" class="form-label">Apellido</label>
                            <div class="input-group mb-3">
                                <input type="text" name="apellido" class="form-control" placeholder="apellido"
                                    aria-label="apellido" aria-describedby="apellido">
                            </div>
                        </div>
                    </div>
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="email" name="email" rows="4" placeholder="Escribí un email..."></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label for="dni" class="form-label"></label>
                        <div class="input-group">
                            <span class="input-group-text">DNI</span>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-3 col-md-4">
                            <label class="form-check-label" for="tipo_usuario">
                                Tipo de usuario
                            </label>
                            <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                                <option value="">Seleccionar tipo de usuario</option>
                                <option value="admin">Administrador</option>
                                <option value="cliente">Cliente</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn boton-custom btn-sm" type="submit">
                            Agregar Usuario
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>