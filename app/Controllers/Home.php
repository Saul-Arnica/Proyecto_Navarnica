<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('templates/main-layout', [
            'title' => 'Principal - Mi Tienda',
            'content' => view('pages/principal')
        ]);
    }
    public function quienesSomos(): string
    {
        return view('quienesSomos');
    }
    public function comercializacion(): string
    {
        return view('comercializacion');
    }
    public function informacionContacto(): string
    {
        return view('pages/informacionContacto');
    }
    public function terminosYUsos(): string
    {
        return view('terminosYUsos');
    }
    public function catalogoProductos(): string
    {
        return view('catalogoProductos');
    }
    public function consultas(): string
    {
        return view('consultas');
    }
}
