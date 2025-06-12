<section class="container py-3">
    <?php $producto['stock'] = 1 ?>

    <div id="carouselExampleIndicators" class="carousel slide w-75 mx-auto" style="max-height: 400px;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="public/assets/img/correa-perro.png" class="d-block mx-auto" alt="..."
                    style="max-height: 400px">
            </div>
            <div class="carousel-item">
                <img src="public/assets/img/castillo-gatuno.jpg" class="d-block mx-auto" alt="..."
                    style="max-height: 400px;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mt-4 bg-light p-4 rounded shadow-sm">
        <h2 class="mb-3 fw-bold text-center"><?= $producto['nombre'] ?></h2>
        <p class="lead text-secondary text-center"><?= $producto['descripcion'] ?></p>
        <div class="d-flex justify-content-between align-items-center">
            <p class="mt-3">
                <span class="badge bg-primary fs-6">
                    Marca: <?= $producto['marca'] ?>
                </span>
                <span class="badge bg-success fs-6 <?= $producto['stock'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                    Stock disponible: <?= $producto['stock'] ?>
                </span>
            </p>

            <p>
                <span class="badge bg-info fs-6">
                    $<?= $producto['precio'] ?>
                </span>
            </p>
        </div>


        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-primary w-100 w-md-50">Agregar al carrito</button>
        </div>
    </div>

</section>