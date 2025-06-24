<?php

namespace App\Controllers;

use App\Models\CategoriaModelo;
use App\Controllers\Productos;
use App\Models\ProductoModelo;
use App\Models\CategoriasProductosModelo;

class Gestion extends BaseController
{

    public function productos()
    {

        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $productosController = new ProductoModelo();
        $productos = $productosController->where('activo', 1)->findAll();

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

        $usuarioModelo = new \App\Models\UsuarioModelo();
        $usuarios = $usuarioModelo->where('activo', 1)->findAll();

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
        $imagenModelo = new \App\Models\ImagenProductoModelo();
        $categorias = $categoriaModelo->findAll();
        $imagenes = $imagenModelo->findAll();

        $data = [
            'categorias' => $categorias,
            'imagenes' => $imagenes
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

    public function editarProducto()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado.');
            return redirect()->to('/login');
        }

        $idProducto = $this->request->getGet('id_producto');
        $productosController = new \App\Controllers\Productos();
        $producto = $productosController->obtenerProductoPorId($idProducto);

        if (!$producto) {
            session()->setFlashdata('error', 'Producto no encontrado.');
            return redirect()->to('/gestion/productos');
        }

        $categoriaModelo = new CategoriaModelo();
        $categorias = $categoriaModelo->findAll();

        $categoriasProductosModelo = new \App\Models\CategoriasProductosModelo();
        $categoriasAsignadas = $categoriasProductosModelo
            ->where('id_producto', $idProducto)
            ->findAll();

        // Extraer solo los id_categoria asociados
        $idsCategoriasAsignadas = array_column($categoriasAsignadas, 'id_categoria');

        $data = [
            'producto' => $producto,
            'categorias' => $categorias,
            'idsCategoriasAsignadas' => $idsCategoriasAsignadas
        ];

        return view('templates/gestion-layout', [
            'title' => 'Editar Producto - Navarnica',
            'content' => view('pages/gestion/modificacionProducto', $data)
        ]);
    }
    public function editarCategoria()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $categoriasController = new \App\Controllers\Categorias();
        $categoria = $categoriasController->obtenerCategoriaPorId($this->request->getGet('id_categoria'));

        if (!$categoria) {
            session()->setFlashdata('error', 'Categoría no encontrada.');
            return redirect()->to('/gestion/categorias');
        }

        $data = [
            'categoria' => $categoria
        ];

        return view('templates/gestion-layout', [
            'title' => 'Editar Categoría - Navarnica',
            'content' => view('pages/gestion/editarCategoria', $data)
        ]);
    }
    public function editarUsuario()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $usuariosController = new \App\Controllers\Usuario();
        $usuario = $usuariosController->obtenerUsuarioPorId($this->request->getGet('id'));

        if (!$usuario) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->to('/gestion/usuarios');
        }

        $data = [
            'usuario' => $usuario
        ];

        return view('templates/gestion-layout', [
            'title' => 'Editar Usuario - Navarnica',
            'content' => view('pages/gestion/editarUsuario', $data)
        ]);
    }

    public function ventas()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $ventasController = new \App\Controllers\Ventas();
        $ventas = $ventasController->obtenerVentas();

        $data = [
            'ventas' => $ventas
        ];

        return view('templates/gestion-layout', [
            'title' => 'Ventas - Navarnica',
            'content' => view('pages/gestion/ventasGestion', $data)
        ]);
    }





}