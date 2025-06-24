<?php

use App\Models\ImagenProductoModelo;

if (!function_exists('guardarImagenesProducto')) {
    function guardarImagenesProducto($imagenes, $idProducto)
    {
        $modeloImagen = new ImagenProductoModelo();

        foreach ($imagenes as $imagen) {
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                $tipo = $imagen->getClientMimeType();

                if (in_array($tipo, ['image/jpeg', 'image/png'])) {
                    $nombreArchivo = $imagen->getRandomName();
                    $rutaDestino = ROOTPATH . 'public/assets/img/img_Productos/';
                    $imagen->move($rutaDestino, $nombreArchivo);

                    $modeloImagen->insert([
                        'id_producto' => $idProducto,
                        'url_imagen' => $nombreArchivo,
                        'descripcion_imagen' => '',
                        'fecha_creacion' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
