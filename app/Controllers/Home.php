<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $productosDestacados = new \App\Controllers\Productos();
        $productos = $productosDestacados->obtenerProductosDestacados();

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

    public function productosPorCategoria(): string
    {
        $productosCategoria = new \App\Controllers\Productos();
        $categoria = $this->request->getGet('categoria');
        $productos = $productosCategoria->obtenerProductosPorCategoria($categoria);


        $data = [
            'productos' => $productos,
            'categoria' => $categoria
        ];
        return view('templates/main-layout', [
            'title' => $categoria . ' - Navarnica',
            'content' => view('pages/productosPorCategoria', $data)
        ]);
    }

    public function producto(): string
    {
        $producto = new \App\Controllers\Productos();
        $id = $this->request->getGet('id');
        $producto = $producto->obtenerProductoPorId($id);

        $data = [
            'producto' => $producto
        ];
        return view('templates/main-layout', [
            'title' => $producto['nombre'],
            'content' => view('pages/producto', $data)
        ]);
    }

    public function registro(): string
    {
        return view('templates/main-layout', [
            'title' => 'registro',
            'content' => view('pages/registro')
        ]);
    }

    public function estamosTrabajando(): string
    {
        return view('templates/main-layout', [
            'title' => 'Estamos trabajando - Navarnica',
            'content' => view('pages/paginaEnProceso')
        ]);
    }
}
