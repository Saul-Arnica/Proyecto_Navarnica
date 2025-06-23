<?php

namespace App\Controllers;

use App\Models\CategoriaModelo;

class Gestion extends BaseController
{

    public function productos()
    {

        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $productosController = new \App\Controllers\Productos();
        $productos = $productosController->obtenerProductos();

        $data = [
            'productos' => $productos
        ];

        return view('templates/gestion-layout', [
            'title' => 'Productos - Navarnica',
            'content' => view('pages/gestion/productosGestion', $data)
        ]);
    }

    public function categorias()
    {

        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $categoriasController = new \App\Controllers\Categorias();
        $categorias = $categoriasController->obtenerCategorias();

        $data = [
            'categorias' => $categorias
        ];

        return view('templates/gestion-layout', [
            'title' => 'Categorías - Navarnica',
            'content' => view('pages/gestion/categoriasGestion', $data)
        ]);
    }

    public function usuarios()
    {

        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $usuariosController = new \App\Controllers\Usuario();
        $usuarios = $usuariosController->obtenerUsuarios();

        $data = [
            'usuarios' => $usuarios
        ];

        return view('templates/gestion-layout', [
            'title' => 'Usuarios - Navarnica',
            'content' => view('pages/gestion/usuariosGestion', $data)
        ]);
    }

    public function consultas()
    {

        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $consultasController = new \App\Controllers\Consulta();
        $consultas = $consultasController->obtenerConsultas();

        $data = [
            'consultas' => $consultas
        ];

        return view('templates/gestion-layout', [
            'title' => 'Consultas - Navarnica',
            'content' => view('pages/gestion/consultasGestion', $data)
        ]);
    }
    
    public function altaProducto()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }
        $categoriaModelo = new CategoriaModelo();
        $categorias = $categoriaModelo->findAll();

        $data = [
            'categorias' => $categorias
        ];

        return view('templates/gestion-layout', [
            'title' => 'Alta producto - Navarnica',
            'content' => view('pages/gestion/altaProducto', $data)
        ]);
    }
    public function altaUsuario()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        return view('templates/gestion-layout', [
            'title' => 'Alta Usuario - Navarnica',
            'content' => view('pages/gestion/altaUsuario')
        ]);
    }
    public function altaCategoria()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        return view('templates/gestion-layout', [
            'title' => 'Alta Categoria - Navarnica',
            'content' => view('pages/gestion/altaCategoria')
        ]);
    }
}
