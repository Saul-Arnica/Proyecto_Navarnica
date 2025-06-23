<?php

namespace App\Controllers;
use App\Models\ImagenProductoModelo; // Importamos el modelo imagen producto
use \App\Models\CategoriasProductosModelo;
use \App\Models\CategoriaModelo; // Importamos el modelo categoria

class Imagenes extends BaseController
{
    private function guardarImagenesProducto($imagenes, $idProducto)
    {
        $modeloImagen = new \App\Models\ImagenProductoModelo();

        foreach ($imagenes as $imagen) {
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                $tipo = $imagen->getClientMimeType();

                if (in_array($tipo, ['image/jpeg', 'image/png'])) {
                    $nombreArchivo = $imagen->getRandomName();
                    $rutaDestino = ROOTPATH . 'public/assets/img/img_Productos/';
                    $imagen->move($rutaDestino, $nombreArchivo);

                    if(!$modeloImagen->insert([
                        'id_producto' => $idProducto,
                        'url_imagen' => 'assets/img/img_Productos/' . $nombreArchivo,
                        'descripcion_imagen' => '',
                        'fecha_creacion' => date('Y-m-d H:i:s')
                    ])) {
                        log_message('error', 'Error al insertar imagen: ' . print_r($modeloImagen->errors(), true));
                    }

                }
            }
        }
    }

    public function altaImagen()
    {
        helper(['form']);

        if ($this->request->getMethod() !== 'post') {
            return redirect()->back()->with('error', 'Método no permitido');
        }

        $imagenArchivo = $this->request->getFile('imagen');
        $idProducto = $this->request->getPost('id_producto');

        if (!$imagenArchivo || !$imagenArchivo->isValid()) {
            return redirect()->back()->with('error', 'Imagen no válida');
        }

        // Validar tipo MIME
        $tipo = $imagenArchivo->getClientMimeType();
        if (!in_array($tipo, ['image/jpeg', 'image/png'])) {
            return redirect()->back()->with('error', 'Solo se permiten imágenes JPG o PNG');
        }

        // Mover la imagen a la carpeta destino
        $nombreArchivo = $imagenArchivo->getRandomName();
        $rutaDestino = ROOTPATH . 'public/assets/img/img_Productos/';
        $imagenArchivo->move($rutaDestino, $nombreArchivo);

        // Guardar en la base de datos
        $modeloImagen = new \App\Models\ImagenProductoModelo();
        $modeloImagen->insert([
            'id_producto' => $idProducto,
            'url_imagen' => 'assets/img/img_Productos/' . $nombreArchivo,
            'descripcion_imagen' => $this->request->getPost('descripcion') ?? '',
            'fecha_creacion' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Imagen agregada correctamente');
    }
}