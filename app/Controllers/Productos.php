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
        $imagen = $modeloImagen
            ->select('url_imagen')
            ->where('id_producto', $idProducto)
            ->first();

        $nombreArchivo = $imagen ? $imagen['url_imagen'] : 'default.png';

        return base_url('public/assets/img/img_Productos/' . $nombreArchivo);
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

        return $productos;
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

        return $productos;
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
        log_message('debug', 'Archivos recibidos: ' . print_r($this->request->getFiles(), true));

        if($this->request->getMethod() !== 'POST') {
            // Manejo de error, por ejemplo, redirigir con un mensaje de error
            session()->setFlashdata('error', 'Método no permitido');
            return redirect()->back();
        }
        $categoriaProductoModelo = new CategoriasProductosModelo();
        $productoModelo = new ProductoModelo();
        $datosProducto = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'descuento' => $this->request->getPost('descuento'),
            'stock' => $this->request->getPost('stock'),
            'marca' => $this->request->getPost('marca'),
            'destacado' => $this->request->getPost('destacado') ? 1 : 0,
        ];

        $resultado = $productoModelo->insert($datosProducto);

        if($resultado === false) {
            // Manejo de error, por ejemplo, redirigir con un mensaje de error
            log_message('error', 'Error en insert: ' . print_r($productoModelo->errors(), true));
            session()->setFlashdata('error', 'Error al crear el producto: ' . implode(', ', $productoModelo->errors()));
            return redirect()->back();
        }
        // Insertar categoria
        $idsCategorias = $this->request->getPost('id_categoria');
        if (is_array($idsCategorias)) {
        foreach ($idsCategorias as $idCategoria) {
            $categoriaProductoModelo->insert([
                'id_producto' => $resultado,
                'id_categoria' => $idCategoria
            ]);
            log_message('debug', 'Categorías insertadas: ' . print_r($idsCategorias, true));

        }

    }

        // Manejo de imágenes
        helper('imagen');

        $imagenes = $this->request->getFiles()['imagenes'] ?? [];
        guardarImagenesProducto($imagenes, $resultado);
        log_message('debug', 'Se llamó a guardarImagenesProducto con ' . count($imagenes) . ' imagenes');

        log_message('debug', 'Imágenes detectadas: ' . print_r($imagenes, true));

        // Si se insertó correctamente, redirigir o mostrar un mensaje de éxito
        session()->setFlashdata('success', 'Producto creado exitosamente.');
        return redirect()->to('/gestion/productos'); // 

    }
    public function bajaProducto($idProducto)
    {
        $productoModelo = new ProductoModelo();
        $producto = $productoModelo->find($idProducto);

        if ($producto === null) {
            session()->setFlashdata('error', 'Producto no encontrado.');
            return redirect()->back();
        }

        if ((int)$producto['activo'] === 0) {
            session()->setFlashdata('warning', 'El producto ya fue dado de baja.');
            return redirect()->back();
        }

        if (!$productoModelo->update($idProducto, ['activo' => 0])) {
            log_message('error', 'Error al dar de baja producto ID ' . $idProducto);
            session()->setFlashdata('error', 'Error al dar de baja el producto.');
            return redirect()->back();
        } else {
            log_message('info', 'Producto ID ' . $idProducto . ' dado de baja correctamente.');
        }

        session()->setFlashdata('success', 'Producto dado de baja correctamente.');
        return redirect()->back();
    }

    public function modificacionProducto()
    {
        log_message('debug', 'Archivos recibidos: ' . print_r($this->request->getFiles(), true));

        $idProducto = $this->request->getPost('id_producto'); 
        $productoModelo = new ProductoModelo();
        $producto = $productoModelo->find($idProducto);

        if ($producto === null) {
            session()->setFlashdata('error', 'Producto no encontrado.');
            return redirect()->back();
        }

        if ((int)$producto['activo'] === 0) {
            session()->setFlashdata('warning', 'El producto está dado de baja y no puede modificarse.');
            return redirect()->back();
        }

        if ($this->request->getMethod() === 'POST') {
            // Validar campos editables
            $reglas = [
                'nombre' => 'permit_empty|min_length[3]|max_length[100]',
                'descripcion' => 'permit_empty|max_length[255]',
                'precio' => 'permit_empty|decimal',
                'stock' => 'permit_empty|integer'
            ];

            if (!$this->validate($reglas)) {
                session()->setFlashdata('error', 'Verifica los datos ingresados.');
                return redirect()->back()->withInput();
            }

            // Recopilar cambios
            $datos = [];
            $campos = ['nombre', 'descripcion', 'precio', 'descuento', 'stock', 'marca', 'activo', 'destacado'];
            foreach ($campos as $campo) {
                $nuevoValor = $this->request->getPost($campo);
                if ($nuevoValor !== null && $nuevoValor !== '' && $nuevoValor != $producto[$campo]) {
                    $datos[$campo] = $nuevoValor;
                }
            }

            // Actualizar producto si hay cambios
            if (!empty($datos)) {
                if (!$productoModelo->update($idProducto, $datos)) {
                    log_message('error', 'Error al modificar producto: ' . print_r($productoModelo->errors(), true));
                    session()->setFlashdata('error', 'No se pudo modificar el producto.');
                    return redirect()->back()->withInput();
                }
            }

            // Actualizar categorías asociadas
            $idsCategorias = $this->request->getPost('id_categoria');
            $categoriasProductosModelo = new \App\Models\CategoriasProductosModelo();
            $categoriasProductosModelo->where('id_producto', $idProducto)->delete();

            if (is_array($idsCategorias)) {
                foreach ($idsCategorias as $idCat) {
                    $categoriasProductosModelo->insert([
                        'id_producto' => $idProducto,
                        'id_categoria' => $idCat
                    ]);
                }
            }

            //Subir imágenes si se enviaron
            helper('imagen');
            $imagenes = $this->request->getFiles()['imagenes'] ?? [];
            if (!empty($imagenes)) {
                guardarImagenesProducto($imagenes, $idProducto);
                log_message('debug', 'Se llamó a guardarImagenesProducto con ' . count($imagenes) . ' imagenes');
            }

            session()->setFlashdata('success', 'Producto modificado correctamente.');
            return redirect()->to('gestion/productos');
        }

        // Si es GET
        return view('productos/editar', ['producto' => $producto]);
    }

}