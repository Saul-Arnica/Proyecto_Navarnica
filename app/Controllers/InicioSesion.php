<?php

namespace App\Controllers;
use App\Models\UsuarioModelo;
use Config\Services;

class InicioSesion extends BaseController
{
    public function login()
    {   
        //Instanciamos modelo de usuario
        $usuarioModelo = new UsuarioModelo();

        // Cargar la librería de validación
        $validation = Services::validation();
        $validation->setRules([
            'email'   => 'required|valid_email',
            'password' => 'required'
        ]);
        // Validación de formulario
        if ($this->request->getMethod() === 'POST') {
            // Reglas de validación

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Obtener datos del formulario
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Buscar usuario por email
            $usuario = $usuarioModelo->where('email', $email)->first();

            // Validar usuario y contraseña
            if ($usuario && password_verify($password, $usuario['password'])) {
                // Guardar datos esenciales en sesión
                session()->set([
                    'id_usuario' => $usuario['id_usuario'],
                    'tipo_usuario' => $usuario['tipo_usuario'], // cliente, admin
                    'usuario_email' => $usuario['email'],
                    'logged_in' => true
                ]);

                // Redirigir según tipo de usuario
                switch ($usuario['tipo_usuario']) {
                    case 'cliente':
                        return redirect()->to('/');
                        break;
                    case 'admin':
                        return redirect()->to('/gestion');
                        break;
                    default:
                        session()->destroy();
                        session()->setFlashdata('error', 'Tipo de usuario no reconocido.');
                        return redirect()->to('/login');
                        break;
                }
            } else {
                // Credenciales incorrectas
                session()->setFlashdata('error', 'Email o contraseña incorrectos.');
                return view('templates/main-layout', [
                    'title' => 'Login - Navarnica',
                    'content' => view('pages/login')
                ]);
            }
        }

        return view('templates/main-layout', [
            'title' => 'Login - Navarnica',
            'content' => view('pages/login')
        ]);
    }

    public function logout()
    {
        // Destruir la sesión y redirigir al login
        session()->destroy();
        return redirect()->to('/login');
    }
}
