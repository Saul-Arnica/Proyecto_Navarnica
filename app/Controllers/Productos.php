<?php

namespace App\Controllers;
use App\Models\ProductoModelo; // Importamos el modelo producto
use App\Models\ImagenProductoModelo; // Importamos el modelo imagen producto

class Productos extends BaseController
{
    public function productos()
    {
        $modeloProducto = new ProductoModelo(); // Creamos instancia del modelo
        $modeloImagenProducto = new ImagenProductoModelo(); // Creamos instancia del modelo de imagen

        $productos = $modeloProducto->findAll(); // Traemos todos los productos
        
        foreach ($productos as &$producto) {
            $imagenes = $modeloImagenProducto->where('producto_id', $producto['id'])->findAll();
            $producto['imagenes'] = $imagenes;

            // Armamos la ruta completa para la primera imagen (si existe)
            if (!empty($imagenes)) {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $producto['imagen'] = base_url('public/assets/img/img_Productos/default.png'); // opcional
            }
        }

        unset($producto); // Limpiamos la referencia al último producto
        
        /*  Esto para cuando ruteemos de forma correcta a la vista de productos
                Si no se encuentra la vista, se mostrará un error 404 automáticamente
                    Si se encuentra, se mostrará la vista con los datos de los productos
        */
        $data = [
            'productos' => $productos
        ];

        return view('productos/index', $data); // Mostramos la vista
    }
    public function productosDestacados()
    {
        $modeloProducto = new \App\Models\ProductoModelo();
        $modeloImagen = new \App\Models\ImagenProductoModelo();

        $productosDestacados = $modeloProducto->where('destacado >', 0)->findAll();

        foreach ($productosDestacados as &$productoDestacado) {
            $imagenes = $modeloImagen->where('producto_id', $productoDestacado['id'])->findAll();

            if (!empty($imagenes)) {
                $productoDestacado['imagen'] = base_url('public/assets/img/img_Productos/' . $imagenes[0]['url_imagen']);
            } else {
                $productoDestacado['imagen'] = base_url('public/assets/img/img_Productos/default.png');
            }
        }

        unset($producto);

        return $productosDestacados;
    }

}
