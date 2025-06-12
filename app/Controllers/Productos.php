<?php

namespace App\Controllers;
use App\Models\ProductoModelo; // Importamos el modelo producto
use App\Models\ImagenProductoModelo; // Importamos el modelo imagen producto
use \App\Models\CategoriasProductosModelo;
use \App\Models\CategoriaModelo; // Importamos el modelo categoria

class Productos extends BaseController
{
    /*Método privado para obtener la imagen principal de un producto
        Si no hay imágenes, devuelve una imagen por defecto*/
    private function obtenerImagenPrincipalDelProducto($idProducto)
    {
        $modeloImagen = new ImagenProductoModelo();
        $imagenes = $modeloImagen->where('id_producto', $idProducto)->findAll();

        return !empty($imagenes)
            ? base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen'])
            : base_url('public/assets/img/img_Productos/default.png');
    }
    //Metodo privado para obtener todas las imagenes de un producto.
    private function obtenerTodasLasImagenesDelProducto($idProducto)
    {
        $modeloImagen = new ImagenProductoModelo();
        $imagenes = $modeloImagen->where('id_producto', $idProducto)->findAll();

        return $imagenes;
    }
    //Metodos privados para obtener las categorias del producto.

    //TODOS LOS PRODUCTOS
    public function obtenerProductos()//listo
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagenProducto = new ImagenProductoModelo();

        $productos = $modeloProducto->findAll();

        foreach ($productos as &$producto) {
            $producto['imagenes'] = $modeloImagenProducto->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagen'] = $this->obtenerImagenPrincipalDelProducto($producto['id_producto']);
        }

        unset($producto); // Limpiamos referencia

        return view('productos/index', ['productos' => $productos]);
    }

    public function obtenerProductosDestacados()//listo
    {
        $modeloProducto = new ProductoModelo();
        $productosDestacados = $modeloProducto->where('destacado >', 0)->findAll();

        foreach ($productosDestacados as &$productoDestacado) {
            $productoDestacado['imagen'] = $this->obtenerImagenPrincipalDelProducto($productoDestacado['id_producto']);
        }

        unset($productoDestacado);

        return $productosDestacados;
    }

    public function obtenerProductoPorId($id)//listo
    {
        if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("ID inválido");
        }

        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $producto = $modeloProducto->find($id);

        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado");
        }

        $producto['imagenes'] = $modeloImagen->where('id_producto', $id)->findAll();
        $producto['imagen'] = $this->obtenerImagenPrincipalDelProducto($id);

        return $producto;
    }

    public function obtenerProductosPorCategoria($categoriaSolicitud)//listo
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();
        $modeloCategoria = new CategoriaModelo();
        $modeloCategoriasProductos = new CategoriasProductosModelo();

        $categoria = $modeloCategoria->where('nombre', $categoriaSolicitud)->first();
        if (!$categoria) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("La categoría '$categoriaSolicitud' no existe.");
        }

        $categoriasProductos = $modeloCategoriasProductos->where('id_categoria', $categoria['id_categoria'])->findAll();
        $idsProductos = array_column($categoriasProductos, 'id_producto');
        $productos = $modeloProducto->whereIn('id_producto', $idsProductos)->findAll();
        foreach ($productos as &$producto) {
            $producto['imagenes'] = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagen'] = $this->obtenerImagenPrincipalDelProducto($producto['id_producto']);
        }
        unset($producto); // Limpiamos referencia
        if (empty($productos)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("No se encontraron productos en la categoría solicitada");
        }
        return $productos;
    }

    public function buscarProductos()//listo
    {
        $busqueda = $this->request->getGet('q');
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->like('nombre', $busqueda)->findAll();

        foreach ($productos as &$producto) {
            $producto['imagenes'] = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagen'] = $this->obtenerImagenPrincipalDelProducto($producto['id_producto']);
        }

        unset($producto);

        return view('productos/busqueda', [
            'productos' => $productos,
            'busqueda' => $busqueda
        ]);
    }

    public function obtenerProductosPorMarca($marca)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('marca', $marca)->findAll();

        foreach ($productos as &$producto) {
            $producto['imagenes'] = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagen'] = $this->obtenerImagenPrincipalDelProducto($producto['id_producto']);
        }

        unset($producto);

        return view('productos/marca', [
            'productos' => $productos,
            'marca' => $marca
        ]);
    }

    public function obtenerProductosPorPrecio($precioMin, $precioMax)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('precio >=', $precioMin)
            ->where('precio <=', $precioMax)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/precio', ['productos' => $productos, 'precioMin' => $precioMin, 'precioMax' => $precioMax]);
    }

    public function obtenerProductosPorNombre($nombre)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->like('nombre', $nombre)->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/nombre', ['productos' => $productos, 'nombre' => $nombre]);
    }

    public function obtenerProductosPorStock($stock)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('stock >=', $stock)->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/stock', ['productos' => $productos, 'stock' => $stock]);
    }

    public function obtenerProductosPorFecha($fechaInicio, $fechaFin) //no
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('fecha_creacion >=', $fechaInicio)
            ->where('fecha_creacion <=', $fechaFin)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/fecha', ['productos' => $productos, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin]);
    }

    public function obtenerProductosPorCalificacion($calificacion)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('calificacion >=', $calificacion)->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/calificacion', ['productos' => $productos, 'calificacion' => $calificacion]);
    }

    public function obtenerProductosPorDescuento($descuento) //capaz usamos
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('descuento >=', $descuento)->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/descuento', ['productos' => $productos, 'descuento' => $descuento]);
    }

    public function obtenerProductosPorCategoriaYMarca($categoria, $marca)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('categoria', $categoria)
            ->where('marca', $marca)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/categoria_marca', ['productos' => $productos, 'categoria' => $categoria, 'marca' => $marca]);
    }

    public function obtenerProductosPorCategoriaYPrecio($categoria, $precioMin, $precioMax)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('categoria', $categoria)
            ->where('precio >=', $precioMin)
            ->where('precio <=', $precioMax)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/categoria_precio', ['productos' => $productos, 'categoria' => $categoria, 'precioMin' => $precioMin, 'precioMax' => $precioMax]);
    }

    public function obtenerProductosPorCategoriaYStock($categoria, $stock) //seguro usamos
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('categoria', $categoria)
            ->where('stock >=', $stock)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/categoria_stock', ['productos' => $productos, 'categoria' => $categoria, 'stock' => $stock]);
    }

    public function obtenerProductosPorCategoriaYFecha($categoria, $fechaInicio, $fechaFin) //capaz capaz usamos
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('categoria', $categoria)
            ->where('fecha_creacion >=', $fechaInicio)
            ->where('fecha_creacion <=', $fechaFin)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/categoria_fecha', ['productos' => $productos, 'categoria' => $categoria, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin]);
    }

    public function obtenerProductosPorCategoriaYCalificacion($categoria, $calificacion) //capaz usamos
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('categoria', $categoria)
            ->where('calificacion >=', $calificacion)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/categoria_calificacion', ['productos' => $productos, 'categoria' => $categoria, 'calificacion' => $calificacion]);
    }

    public function obtenerProductosPorCategoriaYDescuento($categoria, $descuento) //capaz usamos
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('categoria', $categoria)
            ->where('descuento >=', $descuento)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/categoria_descuento', ['productos' => $productos, 'categoria' => $categoria, 'descuento' => $descuento]);
    }

    public function obtenerProductosPorMarcaYPrecio($marca, $precioMin, $precioMax) //capaz usamos
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('marca', $marca)
            ->where('precio >=', $precioMin)
            ->where('precio <=', $precioMax)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/marca_precio', ['productos' => $productos, 'marca' => $marca, 'precioMin' => $precioMin, 'precioMax' => $precioMax]);
    }

    public function obtenerProductosPorMarcaYStock($marca, $stock)
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('marca', $marca)
            ->where('stock >=', $stock)
            ->findAll();

        foreach ($productos as &$producto) {
            $imagenes = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto);

        return view('productos/marca_stock', ['productos' => $productos, 'marca' => $marca, 'stock' => $stock]);
    }

    private function obtenerProductosConTodasLasCategorias(array $idsCategorias)
    {
        $modeloCategoriasProductos = new CategoriasProductosModelo();

        // Obtener todas las filas que tengan esas categorías
        $asociaciones = $modeloCategoriasProductos
            ->whereIn('id_categoria', $idsCategorias)
            ->findAll();

        // Agrupar por id_producto
        $conteoCategorias = [];
        foreach ($asociaciones as $fila) {
            $productoId = $fila['id_producto'];
            if (!isset($conteoCategorias[$productoId])) {
                $conteoCategorias[$productoId] = [];
            }
            $conteoCategorias[$productoId][] = $fila['id_categoria'];
        }

        // Filtrar productos que tengan TODAS las categorías requeridas
        $productosValidos = [];
        foreach ($conteoCategorias as $idProducto => $cats) {
            if (count(array_intersect($cats, $idsCategorias)) === count($idsCategorias)) {
                $productosValidos[] = $idProducto;
            }
        }

        if (empty($productosValidos)) {
            return [];
        }

        $modeloProducto = new ProductoModelo();
        return $modeloProducto
            ->whereIn('id_producto', $productosValidos)
            ->asArray()
            ->findAll();
    }
    public function obtenerProductosPorFiltros($categoriaPrincipal, array $filtrosSubcategorias = [], $precioMin = null, $precioMax = null): array
    {
        $modeloProducto = new ProductoModelo();
        $modeloCategoria = new CategoriaModelo();
        $modeloCategoriasProductos = new CategoriasProductosModelo();
        $modeloImagen = new ImagenProductoModelo();

        $categoriaIds = [];

        // ID de categoría principal
        $catPrincipal = $modeloCategoria->where('nombre', $categoriaPrincipal)->first();
        if (!$catPrincipal) {
            return [];
        }
        $categoriaIds[] = $catPrincipal['id_categoria'];

        // IDs de subcategorías (filtros)
        foreach ($filtrosSubcategorias as $nombreFiltro) {
            $catFiltro = $modeloCategoria->where('nombre', $nombreFiltro)->first();
            if ($catFiltro) {
                $categoriaIds[] = $catFiltro['id_categoria'];
            }
        }
        if (!empty($filtrosSubcategorias) && count($categoriaIds) === 1) {
            // Solo está la categoría principal, no se encontraron subcategorías válidas
            return [];
        }

        // Buscar productos que tengan TODAS esas categorías
        $productosFiltrados = $this->obtenerProductosConTodasLasCategorias($categoriaIds);

        // Filtros por precio
        if ($precioMin !== null) {
            $productosFiltrados = array_filter($productosFiltrados, fn($p) => $p['precio'] >= $precioMin);
        }
        if ($precioMax !== null) {
            $productosFiltrados = array_filter($productosFiltrados, fn($p) => $p['precio'] <= $precioMax);
        }

        // Agregar imágenes
        foreach ($productosFiltrados as &$producto) {
            $producto['imagenes'] = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagen'] = $this->obtenerImagenPrincipalDelProducto($producto['id_producto']);
        }

        return array_values($productosFiltrados);
    }
    public function filtrarProductosAjax()
    {
        $data = $this->request->getJSON(true);

        $categoria = $data['categoria'] ?? '';
        $filtros = $data['filtros'] ?? [];
        $precioMin = $data['precio_min'] ?? null;
        $precioMax = $data['precio_max'] ?? null;

        $productos = $this->obtenerProductosPorFiltros($categoria, $filtros, $precioMin, $precioMax);

        if (empty($productos)) {
            return $this->response->setJSON([]);
        }

        return $this->response->setJSON($productos);
    }
    public function altaProducto() 
    {

    }
    public function bajaProducto() 
    {

    }
    public function modificacionProducto() 
    {

    }
}