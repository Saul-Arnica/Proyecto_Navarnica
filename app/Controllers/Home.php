<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        
        $producto = new \App\Models\ProductoModelo();
        $productos = $producto->findAll(); 
        $data = [
            'productos' => $productos
        ];

        return view('templates/main-layout', [
            'title' => 'Principal - Navarnica',
            'content' => view('pages/principal', $data)
        ]);
    }
    public function quienesSomos(): string
    {
        return view('templates/main-layout', [
            'title' => 'Quienes Somos - Navarnica',
            'content' => view('pages/quienesSomos')
        ]);
    }
    public function comercializacion(): string
    {
        return view('templates/main-layout', [
            'title' => 'Comercializacion - Navarnica',
            'content' => view('pages/comercializacion')
        ]);
    }
    public function informacionContacto(): string
    {
        return view('templates/main-layout', [
            'title' => 'Contacto - Navarnica',
            'content' => view('pages/informacionContacto')
        ]);
    }
    public function terminosYUsos(): string
    {
        return view('templates/main-layout', [
            'title' => 'Terms - Navarnica',
            'content' => view('pages/terminosYUsos')
        ]);
    }
    public function catalogoProductos(): string
    {
        return view('templates/main-layout', [
            'title' => 'Catalogo - Navarnica',
            'content' => view('pages/catalogoProductos')
        ]);
    }
    public function consultas(): string
    {
        return view('templates/main-layout', [
            'title' => 'Consultas - Mi Tienda',
            'content' => view('pages/consultas')
        ]);
    }
}
