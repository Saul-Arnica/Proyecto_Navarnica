<section>
    <div class="container mt-4">
        <div class="row">
            <!-- Columna izquierda: texto de contacto -->
            <div class="col-12 col-lg-6 mb-3 fondo-img-info">
                <h1 class="text-center">Información de Contacto</h1>
                <h6>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</h5>
                <ul class="mt-3">
                    <li class="fw-medium">Email: veteNavarnica@gmail.com</li>
                    <li class="fw-medium">Teléfono:3794-556677</li>
                    <li class="fw-medium">Horario de atención: 09:00AM - 23:00PM</li>
                </ul>
                <p class="fs-6">También puedes seguirnos en nuestras <strong>redes sociales</strong>
                                                para estar al tanto de nuestras <strong>novedades y promociones</strong>.</p>
                <ul class="ul-custom">
                    <li><a href="https://www.facebook.com/VeterinariaNavarnica" target="_blank">
                    <img src="public/assets/img/faceicon.png" class="logos-custom" alt="logo face"> 
                                                    Facebook - Veterinaria Navarnica</a></li>
                    <li><a href="https://www.instagram.com/veterinarianavarnica/" target="_blank">
                    <img src="public/assets/img/instagramicon.png" class="logos-custom" alt="logo face"> 
                                                    Instagram - Veterinaria Navarnica</a></li>
                </ul>
                
            </div>
            
            <!-- Columna derecha: Google Maps -->
            <div class="col-12 col-lg-6">
                <h3 class="text-center">Dirección: Juan V. Pampin 151</h3>
                <div class="ratio ratio-4x3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.281568838954!2d-58.82398178835298!3d-27.460492176226236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456b5a43d02235%3A0x8c16aa8722c013c5!2sJuan%20V.%20Pamp%C3%ADn%20151%2C%20W3402ELC%20Corrientes%2C%20Argentina!5e0!3m2!1ses!2sus!4v1745030440337!5m2!1ses!2sus"
                        width="825" height="375" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class=""></iframe>
                </div>
                
            </div>
        </div>
        
                <br>
        <div class="container-center">
            <div class="row">
                <div class="">
                    <h2>Formulario para consultas generales</h2>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
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
                    
                    <form action="<?= base_url('informacionContacto/enviar') ?>" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
</section>