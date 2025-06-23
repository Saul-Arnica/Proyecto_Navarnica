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

                <!-- Contenedor dinámico de filtros -->
                <div class="mb-3" id="contenedorFiltrosCheckboxes">
                    <!-- Aquí se cargarán los checkboxes dinámicamente con JS -->
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" name="precio_min" placeholder="Mínimo" min="0"
                            id="precioMin">
                        <span class="input-group-text">-</span>
                        <input type="number" class="form-control" name="precio_max" placeholder="Máximo" min="0"
                            id="precioMax">
                    </div>
                </div>

                <button class="btn btn-primary mt-2 w-100" id="btnAplicarFiltros">Aplicar</button>
            </div>
        </aside>

        <!-- Productos -->
        <div class="col-md-10">
            <div class="row g-3" id="contenedorProductos">
                <!-- Aquí se insertarán las cards con JS -->
            </div>
        </div>
    </div>
    <script>

        const filtrosPorCategoria = {
            Mascotas: ['Perros', 'Gatos', 'Peces'],
            Campo: ['Semillas', 'Fertilizantes', 'Herramientas'],
            Insumos: ['Papelería', 'Limpieza', 'Tecnología']
        };

        const productos = <?= json_encode($productos) ?>;
        const categoriaPrincipal = "<?= $categoria ?>";
        const baseImgPath = "<?= base_url('') ?>";
        

        renderizarFiltros(categoriaPrincipal);

        renderizarProductos(productos);


        function renderizarFiltros(categoria) {
            const filtros = filtrosPorCategoria[categoria] || [];
            const contenedor = document.getElementById('contenedorFiltrosCheckboxes');
            contenedor.innerHTML = '';

            filtros.forEach(filtro => {
                const id = `filtro_${filtro}`;
                contenedor.innerHTML += `
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="filtros[]" value="${filtro}" id="${id}">
                <label class="form-check-label" for="${id}">${filtro}</label>
            </div>
        `;
            });
        }

        document.getElementById('btnAplicarFiltros').addEventListener('click', async () => {
            const categoria = categoriaPrincipal; // Podés ponerla dinámica si querés
            const filtros = Array.from(document.querySelectorAll('input[name="filtros[]"]:checked')).map(cb => cb.value);
            const precioMin = document.getElementById('precioMin').value || null;
            const precioMax = document.getElementById('precioMax').value || null;

            const response = await fetch('<?= base_url('api/filtrar-productos') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    categoria,
                    filtros,
                    precio_min: precioMin,
                    precio_max: precioMax
                })
            });

            if (!response.ok) {
                const texto = await response.text();
                console.error("Error del servidor:", texto);
                return;
            }

            const productos = await response.json();

            renderizarProductos(productos);
            console.log(productos);
        });

        function renderizarProductos(productos) {
            const contenedor = document.getElementById('contenedorProductos');
            contenedor.innerHTML = ''; // Limpia los productos actuales

            if (productos.length === 0) {
                contenedor.innerHTML = '<p>No se encontraron productos.</p>';
                return;
            }



            productos.forEach(prod => {
                contenedor.innerHTML += `
                
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <a href="<?= base_url('producto?id=')?>${prod.id_producto}" class="text-decoration-none">
                            <div class="card h-100">
                                <img src="${prod.imagen}" class="card-img-top" alt="${prod.nombre}">
                                <div class="card-body">
                                <h5 class="card-title">${prod.nombre}</h5>
                                <p class="card-text">${prod.descripcion}</p>
                                <p class="card-text">Stock: ${prod.stock}</p>
                                <p class="card-text">$${prod.precio}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                
                `;
            });
        }

        console.log(productos);
    </script>
</div>