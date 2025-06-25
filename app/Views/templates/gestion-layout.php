<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"> <!-- Codificacion de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Para que la pagina se vea bien en dispositivos moviles -->
    <meta name="description" content="Veterinaria Navarnica - La mejor atención de Corrientes Capital"/>
    <link rel="icon" type="image/png" href="<?= base_url('public/assets/img/favicon.png') ?>" />
    <title><?= $title ?? 'Vete Navarnica' ?></title>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('public/assets/css/styles.css') ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"/>
</head>

<body class="bg-light body-gestion">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mi-nav fixed-top px-2 border-bottom">
        <div class="container-fluid">
            <!-- Botón hamburguesa visible en móviles -->
            <button class="btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
                <i class="bi bi-list"></i>
            </button>

            <div class="d-flex align-items-center">
                <img src="<?= base_url('public/assets/img/favicon.png') ?>" height="32" alt="Logo" class="me-2">
                <span class="navbar-brand mb-0 h1">Panel de Gestión</span>
            </div>

            <div class="d-flex align-items-center">
                <a href="<?= base_url('/') ?>" class="btn bg-warning text-white btn-sm">
                    <i class="bi bi-arrow-left">
                        inicio
                    </i>
                </a>

                <a href="<?= base_url('logout') ?>" class="btn boton-custom btn-sm">Cerrar sesión</a>
            </div> 
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar visible en pantallas medianas o más -->
            <aside class="col-md-3 col-lg-2 d-none d-md-block text-white min-vh-100 p-3 sidebar-custom position-fixed">
                <ul class="nav flex-column">
                    <li><a class="nav-link text-white" href="<?= base_url('gestion/ventas') ?>">Ventas</a></li>
                    <li><a class="nav-link text-white" href="<?= base_url('gestion/productos') ?>">Productos</a></li>
                    <li><a class="nav-link text-white" href="<?= base_url('gestion/categorias') ?>">Categorías</a></li>
                    <li><a class="nav-link text-white" href="<?= base_url('gestion/usuarios') ?>">Usuarios</a></li>
                    <li><a class="nav-link text-white" href="<?= base_url('gestion/consultas') ?>">Consultas</a></li>
                </ul>
            </aside>

            <!-- Sidebar Offcanvas para móviles -->
            <div class="offcanvas offcanvas-start offcanvas-gestion text-white" tabindex="-1" id="offcanvasSidebar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="nav flex-column">
                        <li><a class="nav-link text-white" href="<?= base_url('gestion/ventas') ?>">Ventas</a></li>
                        <li><a class="nav-link text-white" href="<?= base_url('gestion/productos') ?>">Productos</a></li>
                        <li><a class="nav-link text-white" href="<?= base_url('gestion/categorias') ?>">Categorías</a></li>
                        <li><a class="nav-link text-white" href="<?= base_url('gestion/usuarios') ?>">Usuarios</a></li>
                        <li><a class="nav-link text-white" href="<?= base_url('gestion/consultas') ?>">Consultas</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contenido principal -->
            <main class="col px-4 py-4 contenido-gestion">
                <?= $content ?? '' ?>
            </main>

        </div>
    </div>

    <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>