<?php

namespace App\Controllers;
use App\Models\ProductoModelo; // Importamos el modelo producto
use App\Models\ImagenProductoModelo; // Importamos el modelo imagen producto

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
    //

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

        return view('productos/detalle', ['producto' => $producto]);
    }

    public function obtenerProductosPorCategoria($categoria)//listo
    {
        $modeloProducto = new ProductoModelo();
        $modeloImagen = new ImagenProductoModelo();

        $productos = $modeloProducto->where('categoria', $categoria)->findAll();

        foreach ($productos as &$producto) {
            $producto['imagenes'] = $modeloImagen->where('id_producto', $producto['id_producto'])->findAll();
            $producto['imagen'] = $this->obtenerImagenPrincipalDelProducto($producto['id_producto']);
        }

        unset($producto);

        return view('productos/categoria', [
            'productos' => $productos,
            'categoria' => $categoria
        ]);
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

}