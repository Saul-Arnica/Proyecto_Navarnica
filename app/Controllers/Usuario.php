<?php
namespace App\Controllers;
use App\Models\UsuarioModelo;

class Usuario extends BaseController
{
    public function altaUsuario($tipoUsuario) //string
    {
        $usuarioModelo = new UsuarioModelo();

        switch($tipoUsuario) {
            case 'admin':
                if ($this->request->getMethod() === 'POST') {
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
                        'tipo_usuario' => 'admin'
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
            case 'empleado':
                
                if ($this->request->getMethod() === 'POST') {
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
                        'apellido' => $this->request->getPost('apellido'),
                        'telefono' => $this->request->getPost('telefono'),
                        'direccion' => $this->request->getPost('direccion'),
                        'email' => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'tipo_usuario' => 'cliente'
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
            case 'cliente':

                if ($this->request->getMethod() === 'POST') {
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
                        'tipo_usuario' => 'cliente'
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