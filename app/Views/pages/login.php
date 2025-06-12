<section class="container py-4">
    <div class="row justify-content-center h-100 pb-4">
        <img src="public/assets/img/logo.png" alt="Logo" class="rounded mx-auto d-block img-login">
    </div>
    <div class="row justify-content-center h-100">
        <div class="col-sm-8 col-md-6 rounded">
            <div class="row">
                <div class="col-sm-10 col-md-12">
                    <?php if (session()->get('errors')): ?>
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                <?php foreach (session()->get('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('login') ?>" method="post">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="email">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" name="email" class="form-control" placeholder="Correo electronico"
                                aria-label="Email" aria-describedby="Email" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="password">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Contraseña"
                                aria-label="Password" aria-describedby="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary btn-sm" type="submit">
                                Ingresar
                            </button>
                        </div>
                    </form>
                    <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <script>
        const sesion = <?= json_encode(session()->get('id_usuario')) ?>;
        console.log("ID de sesión:", sesion);
    </script>

</section>