<?php
namespace App\Controllers;
use App\Models\VentasModelo;

class Ventas extends BaseController
{
    public function obtenerVentas()
    {
        $ventasModelo = new VentasModelo();
        return $ventasModelo->findAll();
    }
}
