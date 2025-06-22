<?php

namespace App\Controllers;
use \App\Models\CategoriaModelo; // Importamos el modelo categoria

class Categorias extends BaseController
{

    public function obtenerCategorias()
    {
        $modeloCategoria = new CategoriaModelo();
        $categorias = $modeloCategoria->findAll();

        return $categorias;
    }

}