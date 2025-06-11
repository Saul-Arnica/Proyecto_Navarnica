<?php
namespace App\Controllers;
use App\Models\UsuarioModelo;

class Usuario extends BaseController
{
    public function altaUsuario()
    {
        $usuarioModelo = new UsuarioModelo();

        switch($this->request->getMethod()) {
            case 'Administrador':
                if ($this->request->getMethod() === 'post') {
                    // Reglas de validación
                    $reglas = [
                        'nombre' => 'required|min_length[3]|max_length[50]',
                        'email' => 'required|valid_email|is_unique[usuarios.email]',
                        'password' => 'required|min_length[6]',
                        'confirm_password' => 'matches[password]'
                    ];

                    if (!$this->validate($reglas)) {
                        session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                        return view('registro_usuario/index');
                    }

                    // Obtener datos del formulario
                    $datos = [
                        'nombre' => $this->request->getPost('nombre'),
                        'email' => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'tipo' => 'admin'
                    ];

                    // Guardar usuario en la base de datos
                    if ($usuarioModelo->insert($datos)) {
                        session()->setFlashdata('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
                        return redirect()->to('/inicio-sesion');
                    } else {
                        session()->setFlashdata('error', 'Error al registrar el usuario. Inténtalo nuevamente.');
                    }
                }
                                                        break;
            case 'Veterinario':
                
                if ($this->request->getMethod() === 'post') {
                    // Reglas de validación
                    $reglas = [
                        'nombre' => 'required|min_length[3]|max_length[50]',
                        'email' => 'required|valid_email|is_unique[usuarios.email]',
                        'password' => 'required|min_length[6]',
                        'confirm_password' => 'matches[password]'
                    ];

                    if (!$this->validate($reglas)) {
                        session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                        return view('registro_usuario/index');
                    }

                    // Obtener datos del formulario
                    $datos = [
                        'nombre' => $this->request->getPost('nombre'),
                        'email' => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'tipo' => 'cliente'
                    ];

                    // Guardar usuario en la base de datos
                    if ($usuarioModelo->insert($datos)) {
                        session()->setFlashdata('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
                        return redirect()->to('/inicio-sesion');
                    } else {
                        session()->setFlashdata('error', 'Error al registrar el usuario. Inténtalo nuevamente.');
                    }
                }
                                                        break;              
            case 'Cliente':

                if ($this->request->getMethod() === 'post') {
                    // Reglas de validación
                    $reglas = [
                        'nombre' => 'required|min_length[3]|max_length[50]',
                        'email' => 'required|valid_email|is_unique[usuarios.email]',
                        'password' => 'required|min_length[6]',
                        'confirm_password' => 'matches[password]'
                    ];

                    if (!$this->validate($reglas)) {
                        session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                        return view('registro_usuario/index');
                    }

                    // Obtener datos del formulario
                    $datos = [
                        'nombre' => $this->request->getPost('nombre'),
                        'email' => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'tipo' => 'cliente'
                    ];

                    // Guardar usuario en la base de datos
                    if ($usuarioModelo->insert($datos)) {
                        session()->setFlashdata('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
                        return redirect()->to('/inicio-sesion');
                    } else {
                        session()->setFlashdata('error', 'Error al registrar el usuario. Inténtalo nuevamente.');
                    }
                }
                                                        break;          
            default:
                // Método no permitido
                return redirect()->back()->with('error', 'Tipo de usuario no permitido.');
        }
    }     
}