<div class="container-fluid">
    <!-- Botón para abrir filtros (visible solo en móviles) -->
    <div class="d-md-none text-end my-3">
        <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarFiltros">
            Filtros
        </button>
    </div>

    <div class="row">
        <!-- Sidebar colapsable -->
        <aside class="col-md-2 mb-4 collapse d-md-block" id="sidebarFiltros">
            <div class="bg-light p-3 rounded shadow-sm">
                <h5 class="mb-3">Filtros</h5>

                <!-- Ejemplo de filtros -->
                <div class="mb-3">
                    <label class="form-label">Especie</label>
                    <select class="form-select">
                        <option>Todos</option>
                        <option>Perros</option>
                        <option>Gatos</option>
                        <option>Peces</option>
                        <option>Otros</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" name="precio_min" placeholder="Mínimo" min="0">
                        <span class="input-group-text">-</span>
                        <input type="number" class="form-control" name="precio_max" placeholder="Máximo" min="0">
                    </div>
                </div>

                <button class="btn btn-primary mt-2 w-100">Aplicar</button>
            </div>
        </aside>

        <!-- Productos -->
        <div class="col-md-10">
            <div class="row g-3">

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <img src="public/assets/img/sergio.jpg" class="card-img-top" alt="prueba">
                        <div class="card-body">
                            <h5 class="card-title">prueba</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p class="card-text">Stock: 4</p>
                            <p class="card-text">$200</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <img src="public/assets/img/sergio.jpg" class="card-img-top" alt="prueba">
                        <div class="card-body">
                            <h5 class="card-title">prueba</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p class="card-text">Stock: 4</p>
                            <p class="card-text">$200</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <img src="public/assets/img/sergio.jpg" class="card-img-top" alt="prueba">
                        <div class="card-body">
                            <h5 class="card-title">prueba</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p class="card-text">Stock: 4</p>
                            <p class="card-text">$200</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <img src="public/assets/img/sergio.jpg" class="card-img-top" alt="prueba">
                        <div class="card-body">
                            <h5 class="card-title">prueba</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p class="card-text">Stock: 4</p>
                            <p class="card-text">$200</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <img src="public/assets/img/sergio.jpg" class="card-img-top" alt="prueba">
                        <div class="card-body">
                            <h5 class="card-title">prueba</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p class="card-text">Stock: 4</p>
                            <p class="card-text">$200</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <img src="public/assets/img/sergio.jpg" class="card-img-top" alt="prueba">
                        <div class="card-body">
                            <h5 class="card-title">prueba</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <p class="card-text">Stock: 4</p>
                            <p class="card-text">$200</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>