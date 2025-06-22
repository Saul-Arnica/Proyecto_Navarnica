<section class="container py-3">

    <h1 class="text-center mt-2">Catálogo</h1>


    <div class="row mt-3 p-3">
        <div class="col-12 col-lg-4 col-md-6 d-flex justify-content-center mt-5">
            <a href="<?= base_url('productosPorCategoria?categoria=Mascotas') ?>" class="position-relative d-inline-block text-decoration-none">
                <img src="public/assets/img/mascotas.jpg" alt="sergio" class="img-catalogo-custom img-fluid rounded" />
                <p class="overlay-catalogo-text">
                    Mascotas
                </p>
            </a>
        </div>

        <div class="col-12 col-lg-4 col-md-6 d-flex justify-content-center mt-5">
            <a href="<?= base_url('productosPorCategoria?categoria=Campo') ?>" class="position-relative d-inline-block text-decoration-none">
                <img src="public/assets/img/campo.jpg" alt="sergio" class="img-catalogo-custom img-fluid rounded" />
                <p class="overlay-catalogo-text">
                    Campo
                </p>
            </a>
        </div>

        <div class="col-12 col-lg-4 col-md-6 d-flex justify-content-center mt-5">
            <a href="<?= base_url('productosPorCategoria?categoria=Insumos') ?>" class="position-relative d-inline-block text-decoration-none">
                <img src="public/assets/img/insumos.jpg" alt="sergio" class="img-catalogo-custom img-fluid rounded" />
                <p class="overlay-catalogo-text">
                    Insumos
                </p>
            </a>
        </div>
    </div>
</section>