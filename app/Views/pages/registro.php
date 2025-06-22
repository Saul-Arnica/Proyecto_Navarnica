<section class="container py-4 registro-form rounded h-100">
    <div class="row justify-content-center pb-4">
        <img src="public/assets/img/logo.png" alt="Logo" class="rounded mx-auto d-block img-registro">
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-6 rounded">
            <div class="row">
                <div class="col-sm-10 col-md-12">
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

                    <form action="<?= base_url('registro') ?>" method="post" id="formularioCliente">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="nombre">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                                        aria-label="Nombre" aria-describedby="Nombre" required>
                                </div>
                                <input type="hidden" name="tipo_usuario" value="cliente">
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="apellido">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" name="apellido" class="form-control" placeholder="Apellido"
                                        aria-label="Apellido" aria-describedby="Apellido">
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="email">
                                <i class="bi bi-envelope-at-fill"></i>
                            </span>
                            <input type="text" name="email" class="form-control" placeholder="Correo electronico"
                                aria-label="Email" aria-describedby="Email" required>
                        </div>
                        <div class="input-group mb-3">
                                    <span class="input-group-text" id="dni">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="number" name="dni" class="form-control" placeholder="DNI"
                                        aria-label="DNI" aria-describedby="DNI">
                                </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="password">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Contraseña"
                                aria-label="Password" aria-describedby="Password" required>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="telefono">
                                        <i class="bi bi-telephone-fill"></i>
                                    </span>
                                    <input type="text" name="telefono" class="form-control" placeholder="Telefono"
                                        aria-label="Telefono" aria-describedby="Telefono">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="direccion">
                                        <i class="bi bi-house-door-fill"></i>
                                    </span>
                                    <input type="text" name="direccion" class="form-control" placeholder="Direccion"
                                        aria-label="Direccion" aria-describedby="Direccion">
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn boton-custom btn-sm" type="submit">
                                Registrarse
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</section>