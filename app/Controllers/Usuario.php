<?php
namespace App\Controllers;
use App\Models\UsuarioModelo;

class Usuario extends BaseController
{
    public function altaUsuario() //string
    {
        $usuarioModelo = new UsuarioModelo();

        $tipoUsuario = 'cliente';

        switch($tipoUsuario) {
            case 'admin':
                if ($this->request->getMethod() === 'POST') {
                    // Reglas de validación
                    $reglas = [
                        'nombre' => 'required|min_length[3]|max_length[50]',
                        'email' => 'required|valid_email|is_unique[Usuarios.email]',
                        'password' => 'required|min_length[6]',
                        'confirm_password' => 'matches[password]'
                    ];

                    if (!$this->validate($reglas)) {
                        session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                        return redirect()->to('/registro');
                    }

                    // Obtener datos del formulario
                    $datos = [
                        'nombre' => $this->request->getPost('nombre'),
                        'apellido' => $this->request->getPost('apellido'),
                        'email' => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'telefono' => $this->request->getPost('telefono'),
                        'direccion' => $this->request->getPost('direccion'),
                        'activo' => 1, // Usuario activo por defecto
                        'tipo_usuario' => 'admin'
                    ];

                    if (!$usuarioModelo->insert($datos)) {
                        log_message('error', 'Error en insert: ' . print_r($usuarioModelo->errors(), true));
                        session()->setFlashdata('error', 'Error al registrar el usuario. Inténtalo nuevamente.');
                    }


                    // Guardar usuario en la base de datos
                    $resultado = $usuarioModelo->insert($datos);

                    if (!$resultado) {
                        log_message('error', 'Error en insert: ' . print_r($usuarioModelo->errors(), true));
                        session()->setFlashdata('error', 'Error al registrar el usuario. Inténtalo nuevamente.');
                        return redirect()->to('/registro');
                    }

                    session()->setFlashdata('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
                    return redirect()->to('/login');
                }
                                                        break;
            case 'empleado':
                
                if ($this->request->getMethod() === 'POST') {
                    // Reglas de validación
                    $reglas = [
                        'nombre' => 'required|min_length[3]|max_length[50]',
                        'email' => 'required|valid_email|is_unique[Usuarios.email]',
                        'password' => 'required|min_length[6]',
                        'confirm_password' => 'matches[password]'
                    ];

                    if (!$this->validate($reglas)) {
                        session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                        return redirect()->to('/registro');
                    }

                    // Obtener datos del formulario
                    $datos = [
                        'nombre' => $this->request->getPost('nombre'),
                        'apellido' => $this->request->getPost('apellido'),
                        'email' => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'telefono' => $this->request->getPost('telefono'),
                        'direccion' => $this->request->getPost('direccion'),
                        'activo' => 1, // Usuario activo por defecto
                        'tipo_usuario' => 'empleado'
                    ];

                    // Guardar usuario en la base de datos
                    $resultado = $usuarioModelo->insert($datos);

                    if (!$resultado) {
                        log_message('error', 'Error en insert: ' . print_r($usuarioModelo->errors(), true));
                        session()->setFlashdata('error', 'Error al registrar el usuario. Inténtalo nuevamente.');
                        return redirect()->to('/registro');
                    }

                    session()->setFlashdata('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
                    return redirect()->to('/login');
                }
                                                        break;              
            case 'cliente':

                if ($this->request->getMethod() === 'POST') {
                    $reglas = [
                        'nombre' => 'required|min_length[3]|max_length[50]',
                        'email' => 'required|valid_email|is_unique[Usuarios.email]',
                        'password' => 'required|min_length[6]',
                    ];

                    if (!$this->validate($reglas)) {
                        session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                        return redirect()->to('/registro');
                    }

                    $datos = [
                        'nombre' => $this->request->getPost('nombre'),
                        'apellido' => $this->request->getPost('apellido'),
                        'email' => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'telefono' => $this->request->getPost('telefono'),
                        'direccion' => $this->request->getPost('direccion'),
                        'tipo_usuario' => 'cliente',
                        'activo' => 1,
                    ];

                    $resultado = $usuarioModelo->insert($datos);

                    if (!$resultado) {
                        log_message('error', 'Error en insert: ' . print_r($usuarioModelo->errors(), true));
                        session()->setFlashdata('error', 'Error al registrar el usuario. Inténtalo nuevamente.');
                        return redirect()->to('/registro');
                    }

                    session()->setFlashdata('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
                    return redirect()->to('/login');
                }
                                                        break;          
            default:
                // Método no permitido
                return redirect()->back()->with('error', 'Tipo de usuario no permitido.');
        }
    }
    public function bajaUsuario($idUsuario)
    {
        $usuarioModelo = new UsuarioModelo();
        $usuario = $usuarioModelo->find($idUsuario);

        if ($usuario === null) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->back();
        }

        if ((int)$usuario['activo'] === 0) {
        session()->setFlashdata('warning', 'El usuario ya está desactivado.');
        return redirect()->back();
        }

        // Usuario encontrado, puedes realizar la baja
        session()->setFlashdata('info', 'El usuario se encontro y se elimino.');
        $usuarioModelo->update($idUsuario, ['activo' => 0]); // Desactivar usuario
        return redirect()->back();
    }


}