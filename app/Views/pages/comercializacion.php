<section>

    <div class="container-fluid mt-4 mb-3 text-center">
        <h2>COMERCIALIZACION</h2>
        <!-- Carrusel de Imagenes de Comercializacion-->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active carousel-comercializacion">
                    <img src="public/assets/img/imagen_recortada.png" class="w-100" alt="...">
                </div>

                <div class="carousel-item carousel-comercializacion">
                    <img src="public/assets/img/promo-abril.jpg" class="w-100 " alt="...">
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
        <!--Iconos de Comercializacion-->
        <div class="container-flex text-center">

            <div class="row align-items-center">

                <div class="col-lg-4">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn boton-custom-comercializacion" data-bs-toggle="modal" data-bs-target="#modalPagos">
                        <img src="public/assets/img/formadepago.png" class="logos-comercializacion logos-comercializacion-modal" alt="...">
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalPagos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="exampleModalLabel">Formas de Pago</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul style="text-align: left">
                                        <li>
                                            <img src="public/assets/img/Visa-logo.png" class="logos-comercializacion" style="max-height: 35px;" alt="logo-visa">
                                        </li>
                                        <li>
                                            <img src="public/assets/img/Mastercard-logo.png" class="logos-comercializacion ms-2" style="max-height: 65px;" alt="logo-mastercard">
                                        </li>
                                        <li>
                                            <img src="public/assets/img/amex.png" class="logos-comercializacion" style="max-height: 40px;" alt="logo-american-express">
                                        </li>
                                        <li>
                                            <img src="public/assets/img/brubank.png" class="logos-comercializacion ms-4" style="max-height: 60px;" alt="logo-brubank">
                                        </li>
                                        <li>
                                            <img src="public/assets/img/mp.png" class="logos-comercializacion" style="max-height: 100px;" alt="logo-mercadopago">
                                        </li>
                                        <li>
                                            <img src="public/assets/img/uala.png" class="logos-comercializacion ms-4" style="max-height: 60px;" alt="logo-uala">
                                        </li>
                                        <li>
                                            <img src="public/assets/img/transferencia.png" class="logos-comercializacion ms-1" style="max-height: 75px;" alt="logo-transferencia">
                                        </li>
                                        <li class="mt-3 p-1">
                                            <img src="public/assets/img/efectivo.png" class="logos-comercializacion ms-1" style="max-height: 75px;" alt="logo-efectivo">
                                        </li>
                                        <li class="list-unstyled aling-items-center mt-2 p-1">
                                            <i class="bi bi-credit-card-fill text-success me-2 fs-2"></i>
                                            <strong>En 3-6-9-12 cuotas con Visa y Mastercard</strong>
                                        </li>
                                    </ul>
                                    <p class="text-center text-muted" style="font-size: 0.9rem;">*No se aceptan pagos en cuotas con Mercado Pago ni Uala</p>

                                </div>

                            </div>

                        </div>

                    </div>
                    <p style="text-align: center"><strong>Aceptamos todo tipo de tarjetas y efectivo</strong></p>
                </div>

                <div class="col-lg-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn boton-custom-comercializacion" data-bs-toggle="modal" data-bs-target="#modalSucursal">
                        <img src="public/assets/img/tienda.png" class="logos-comercializacion logos-comercializacion-modal" alt="logo-sucursal">
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalSucursal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="exampleModalLabel">Sucursales</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul style="text-align: left">
                                        <li>
                                            <p><strong>Hipólito Yrigoyen 1373</strong></p>
                                        </li>
                                        <li>
                                            <p><strong>Juan V. Pampin 151</strong></p>

                                        </li>

                                    </ul>
                                    <i class="bi bi-shop fs-1 text-info"></i>
                                    <p class="text-success-emphasis fs-5 fw-semibold mt-1 text-center">Las compras en sucursal tienen 7% de descuento pagando en efectivo.</p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <p class="text-center"><strong>Se puede retirar por sucursal</strong></p>

                </div>

                <div class="col-lg-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn boton-custom-comercializacion" data-bs-toggle="modal" data-bs-target="#modalEnvios">
                        <img src="public/assets/img/envio.png" class="logos-comercializacion logos-comercializacion-modal" alt="logo-envio">
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalEnvios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="exampleModalLabel">Metodos de Envio</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul style="text-align: left mb-2 mt-2">
                                        <i class="bi bi-truck-front-fill text-success fs-4 "> Se hacen envios al interior mediante:</i>

                                        <img src="public/assets/img/Andreani.png" class="logos-comercializacion" style="max-height: 45px;" alt="logo-Andreani">

                                        <img src="public/assets/img/correo-oca-logo-png_seeklogo-507837.png" class="logos-comercializacion ms-2" style="max-height: 100px;" alt="logo-OCA">


                                        <p class="text-success-emphasis text-center fs-5 fw-semibold mt-1">Para envios dentro de Corrientes Capital, hay 7% de descuento por envío pagando en <strong>efectivo</strong>.</p>

                                    </ul>
                                    <p class="text-center text-muted" style="font-size: 0.9rem;">*Para que el envío sea gratis entre las 4 avenidas de Corrientes Capital, debe ser mínimo 30kg o una compra de $35.000 en adelante</p>

                                </div>

                            </div>

                        </div>

                    </div>
                    <p style="text-align: center"><strong>Se envia a domicilio</strong></p>
                </div>

            </div>

        </div>

    </div>

</section>