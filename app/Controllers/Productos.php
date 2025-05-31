<?php

namespace App\Controllers;
use App\Models\ProductoModelo; // Importamos el modelo

class Productos extends BaseController
{
    public function index()
    {
        $model = new ProductoModelo(); // Creamos instancia del modelo
        $productos = $model->findAll(); // Traemos todos los productos

        $data = [
            'productos' => $productos
        ];

        return view('productos/index', $data); // Mostramos la vista
    }
}
