<?php

namespace App\Controllers;
use \App\Models\ConsultaModelo;

class Consulta extends BaseController
{

    public function obtenerConsultas()
    {
        $modeloConsulta = new ConsultaModelo();
        $consultas = $modeloConsulta->findAll();

        return $consultas;
    }

}