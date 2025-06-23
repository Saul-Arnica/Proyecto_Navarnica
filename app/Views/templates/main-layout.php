<!DOCTYPE html>
<html>
<lang="es">

    <head>
        <meta charset="UTF-8"> <!-- Codificacion de caracteres -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Para que la pagina se vea bien en dispositivos moviles -->
        <meta name="description" content="Veterinaria Navarnica - La mejor atención de Corrientes Capital"/> <!-- Descripción de la página cuando la buscamos-->
        <link rel="icon" type="image/png" href="<?= base_url('public/assets/img/favicon.png') ?>" /> <!-- Icono de la pestaña -->
        <title><?= $title ?? 'Vete Navarnica' ?></title> <!-- Titulo de la pestaña -->
        <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" /> <!-- Bootstrap CSS -->
        <link rel="canonical" href="http://VeterinariaNavarnica.com/" /> <!-- URL canónica para evitar contenido duplicado y que tome -->
        <link rel="stylesheet" href="<?= base_url('public/assets/css/styles.css') ?>" /> <!-- CSS personalizado -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" /> <!-- Bootstrap Icons -->
    </head>

    <body>

        <div class="container-custom">

            <header>
                <?= view("components/navbar") ?>
            </header>

            <main>
                <?= $content ?? '' ?>
            </main>

            <footer>
                <?= view("components/footer") ?>
            </footer>

        </div>

        <script src="public/assets/js/bootstrap.bundle.min.js"></script>
    </body>

</html>