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
            <?php if (is_iterable($producto['imagenes']) && count($producto['imagenes']) > 0): ?>
                <?php foreach ($producto['imagenes'] as $index => $imagen): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url('public/assets/img/img_Productos/' . esc($imagen['url_imagen'])) ?>" class="d-block mx-auto" alt="Imagen del producto"
                            style="max-height: 400px;">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="carousel-item active">
                    <img src="<?= base_url('public/assets/img/img_Productos/default.png') ?>" class="d-block mx-auto" alt="Imagen por defecto"
                        style="max-height: 400px;">
                </div>
            <?php endif; ?>
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


        <?php if (session()->get('tipo_usuario') === 'admin'): ?>
            <div class="text-center">
                <a href="<?= base_url('gestion/editarProducto?id_producto=' . $producto['id_producto']) ?>"
                    class="btn btn-warning">Editar Producto</a>
            </div>
       <?php endif; ?>

        <?php if (session()->get('tipo_usuario') !== 'admin'): ?>
                <div class="d-flex justify-content-center">
                <form action="<?= base_url('carrito/agregar') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
                    <div class="row">
                        <div class="col px-2">
                            <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2 col">
                        </div>
                        <div class="col px-2">
                            <button type="submit" class="btn btn-outline-primary w-100 w-md-50 col">Agregar al carrito</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>            
    </div>

</section>