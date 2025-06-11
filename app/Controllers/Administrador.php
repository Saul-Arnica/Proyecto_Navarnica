<?php

namespace App\Controllers;
use App\Models\UsuarioModelo;

class Administrador extends BaseController
{
    public function gestion()
    {
        echo "Bienvenido al panel de administración";
        // Verificar si el usuario está logueado y es admin
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado.');
            return redirect()->to('/login');
        }

        // Aquí podrías cargar datos específicos para la gestión del administrador
        $usuarioModelo = new UsuarioModelo();
        $usuarios = $usuarioModelo->findAll();

        return view('templates/main-layout', [
            'title' => 'Gestión - Navarnica',
            'content' => view('pages/gestionAdministrador', ['usuarios' => $usuarios])
        ]);
    }
}