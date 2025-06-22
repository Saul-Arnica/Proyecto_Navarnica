<?php
namespace App\Controllers;


class Gestion extends BaseController
{
    public function gestion(): string
    {
        return view('templates/gestion-layout', [
            'title' => 'Dashboard - Navarnica',
            'content' => view('pages/gestion/dashboardGestion')
        ]);
    }

    public function productos(): string
    {
        return view('templates/gestion-layout', [
            'title' => 'Productos - Navarnica',
            'content' => view('pages/gestion/productosGestion')
        ]);
    }

    public function categorias(): string
    {
        return view('templates/gestion-layout', [
            'title' => 'Categorías - Navarnica',
            'content' => view('pages/gestion/categoriasGestion')
        ]);
    }

    public function usuarios(): string
    {
        return view('templates/gestion-layout', [
            'title' => 'Usuarios - Navarnica',
            'content' => view('pages/gestion/usuariosGestion')
        ]);
    }

    public function consultas(): string
    {
        return view('templates/gestion-layout', [
            'title' => 'Consultas - Navarnica',
            'content' => view('pages/gestion/consultasGestion')
        ]);
    }
}
