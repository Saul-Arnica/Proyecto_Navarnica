<?php
$actualMethod = service('router')->methodName();
?>

<nav class="navbar navbar-expand-lg mi-nav px-2 border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand <?= ($actualMethod === 'index') ? 'active text-success' : '' ?>"
            href="<?= base_url() ?>">
            <img src="public/assets/img/favicon.png" class="navbar-logo logos-comercializacion-modal" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse collapse-custom-navbar" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ul-custom-navbar">
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'index') ? 'active text-success' : '' ?>"
                        href="<?= base_url() ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'quienesSomos') ? 'active text-success' : '' ?>"
                        href="<?= base_url('quienesSomos') ?>">Quienes Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'informacionContacto') ? 'active text-success' : '' ?>"
                        href="<?= base_url('informacionContacto') ?>">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'comercializacion') ? 'active text-success' : '' ?>"
                        href="<?= base_url('comercializacion') ?>">Comercializacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'terminosYUsos') ? 'active text-success' : '' ?>"
                        href="<?= base_url('terminosYUsos') ?>">Términos y usos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  <?= ($actualMethod === 'catalogoProductos' || strpos($actualMethod, 'producto') !== false) ? 'active text-success' : '' ?>"
                        href="<?= base_url('catalogoProductos') ?>">Catalago</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link  <?= ($actualMethod === 'consultas') ? 'active text-success' : '' ?>"
                        href="<?= base_url('consultas') ?>">Consultas</a>
                </li> -->
                <?php if (session()->get('tipo_usuario') === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($actualMethod === 'gestion') ? 'active text-success' : '' ?>"
                            href="<?= base_url('gestion') ?>">Gestión</a>
                    </li>
                <?php endif; ?>
                <?php if (session()->get('id_usuario')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>">Cerrar sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($actualMethod === 'login') || ($actualMethod === 'registro') ? 'active text-success' : '' ?>"
                            href="<?= base_url('login') ?>">Iniciar sesión</a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($carrito)): ?>
                    <span class="badge bg-primary"><i class="bi bi-cart-fill"></i><?= count($carrito) ?></span>
                <?php else: ?>
                    <a href="<?= base_url('carrito') ?>" class="badge bg-secondary"><i class="bi bi-cart-fill"></i></a>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>