<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        #return view('welcome_message');
        return view('principal');
    }
    public function quienes_Somos(): string
    {
        return view('quienes_somos');
    }
    public function comercializacion(): string
    {
        return view('comercializacion');
    }
    public function informacion_Contacto(): string
    {
        return view('informacion_contacto');
    }
    public function terminos_Y_Usos(): string
    {
        return view('terminos_y_usos');
    }
    public function catalogo_Productos(): string
    {
        return view('catalogo_productos');
    }
    public function consultas(): string
    {
        return view('consultas');
    }
}
