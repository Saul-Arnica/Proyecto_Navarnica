<section class="bg-principal-custom">
    <div class="principal-custom">
        <div class="container-fluid principal-img-bg text-center">
            <!-- Card: Solicitar Turno -->
            <div class="row justify-content-center">

                <div class="col-12 col-md-6 col-lg-4 mb-3 mt-3">

                    <div class="card w-10 shadow-sm rounded-pill card-custom1 ">

                        <div class="card-body text-center">

                            <h5 class="card-title">Reserva tu turno</h5>

                            <p class="card-text text-center">Para tu mascota de forma rápida y sencilla.</p>
                            <a href="<?= base_url() ?>" class="btn btn-primary text-white rounded-pill">Solicitar Turno</a>

                        </div>

                    </div>

                </div>

                <!-- Card: Ver productos -->
                <div class="col-12 col-md-6 col-lg-4 mb-3 mt-3">

                    <div class="card w-10 shadow-sm rounded-pill card-custom2 text-white">

                        <div class="card-body text-center">

                            <h5 class="card-title">Productos Caninos y Felinos!</h5>
                            <p class="card-text text-center">Los mejores precios de Corrientes Capital.</p>

                            <a href="<?= base_url('catalogoProductos') ?>" class="btn btn-info text-white rounded-pill">Ver Productos</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="container pb-5 mt-5">
        <h1 class="text-center mt-5">Productos destacados</h1>

        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner" id="carouselInner"></div>

            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>

        </div>

    </div> 
</div>

</section>

<!-- Scripts -->
<script src="<?= base_url('public/assets/js/carrusel_productos.js') ?>"></script>

<script>
    const products = <?= json_encode($productos) ?>;
    const baseUrl = '<?= base_url() ?>';
    function initCarousel() {
        generateProductCarousel(products, 'carouselInner');
    }

    initCarousel();

    window.addEventListener('resize', () => {
        initCarousel();
    });

    console.log(products);
</script>
