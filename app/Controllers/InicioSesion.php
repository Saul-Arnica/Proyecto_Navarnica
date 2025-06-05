<?php

namespace App\Controllers;
use App\Models\UsuarioModelo;

class InicioSesion extends BaseController
{
    public function inicioDeSesion()
    {
        $usuarioModelo = new UsuarioModelo();

        // Validación de formulario
        if ($this->request->getMethod() === 'post') {
            // Reglas de validación
            $reglas = [
                'email'    => 'required|valid_email',
                'password' => 'required'
            ];

            if (!$this->validate($reglas)) {
                session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                return view('inicio_sesion/index');
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
                    'usuario_id' => $usuario['id'],
                    'usuario_tipo' => $usuario['tipo'], // cliente, admin
                    'usuario_email' => $usuario['email'],
                    'logueado' => true
                ]);

                // Redirigir según tipo de usuario
                switch ($usuario['tipo']) {
                    case 'cliente':
                        return redirect()->to('/cliente/dashboard');
                    case 'admin':
                        return redirect()->to('/admin/gestion');
                    default:
                        session()->destroy();
                        session()->setFlashdata('error', 'Tipo de usuario no reconocido.');
                        return redirect()->to('/inicio-sesion');
                }
            } else {
                // Credenciales incorrectas
                session()->setFlashdata('error', 'Email o contraseña incorrectos.');
                return view('inicio_sesion/index');
            }
        }

        return view('inicio_sesion/index');
    }
}
