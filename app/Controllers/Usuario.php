<?php
namespace App\Controllers;
use App\Models\UsuarioModelo;

class Usuario extends BaseController
{
    public function registroCliente()
    {
        
        if ($this->request->getMethod() === 'POST') {
            $usuarioModelo = new UsuarioModelo();

                    $reglas = [
                        'nombre' => 'required|min_length[3]|max_length[50]',
                        'apellido' => 'required|min_length[3]|max_length[50]',
                        'dni' => 'required|min_length[7]|max_length[9]',
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
                        'dni' => $this->request->getPost('dni')
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
    }
    public function altaUsuario() //string
    {
        if($this->request->getMethod() === 'POST') {

            $usuarioModelo = new UsuarioModelo();

            $tipoUsuario = $this->request->getPost('tipo_usuario');

            switch($tipoUsuario) {
                case 'admin':
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
                                                            break;              
                case 'cliente':
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
                                                            break;          
                default:
                    // Método no permitido
                    return redirect()->back()->with('error', 'Tipo de usuario no permitido.');
            }
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
        session()->setFlashdata('warning', 'El usuario ya ha sido eliminado.');
        return redirect()->back();
        }

        // Usuario encontrado, puedes realizar la baja
        session()->setFlashdata('info', 'El usuario se encontro y se elimino.');
        $usuarioModelo->update($idUsuario, ['activo' => 0]); // Desactivar usuario
        return redirect()->back();
    }

    public function modificacionUsuario($idUsuario)
    {
        $usuarioModelo = new UsuarioModelo();
        $usuario = $usuarioModelo->find($idUsuario);

        if ($usuario === null) {
            session()->setFlashdata('error', 'Usuario no encontrado.');
            return redirect()->back();
        }

        if ((int)$usuario['activo'] === 0) {
            session()->setFlashdata('warning', 'El usuario fue eliminado.');
            return redirect()->back();
        }

        if ($this->request->getMethod() === 'POST') {

            // Reglas mínimas para validar si los campos están bien formados
            $reglas = [
                'nombre'    => 'permit_empty|min_length[3]|max_length[50]',
                'apellido'  => 'permit_empty|min_length[3]|max_length[50]',
                'email'     => "permit_empty|valid_email|is_unique[Usuarios.email,id,{$idUsuario}]",
                'password'  => 'permit_empty|min_length[6]',
            ];

            if (!$this->validate($reglas)) {
                session()->setFlashdata('error', 'Verifica los datos ingresados.');
                return redirect()->back()->withInput();
            }

            $datos = [];

            // Comparar campo por campo, si está presente, no vacío y diferente, agregarlo
            $campos = ['nombre', 'apellido', 'email', 'telefono', 'direccion', 'tipo_usuario', 'activo'];
            foreach ($campos as $campo) {
                $nuevoValor = $this->request->getPost($campo);
                if ($nuevoValor !== null && $nuevoValor !== '' && $nuevoValor != $usuario[$campo]) {
                    $datos[$campo] = $nuevoValor;
                }
            }

            $nuevaPassword = $this->request->getPost('password');
            if (!empty($nuevaPassword)) {
                $datos['password'] = password_hash($nuevaPassword, PASSWORD_DEFAULT);
            }

            if (empty($datos)) {
                session()->setFlashdata('info', 'No se realizaron cambios.');
                return redirect()->back();
            }

            if (!$usuarioModelo->update($idUsuario, $datos)) {
                log_message('error', 'Error al actualizar usuario: ' . print_r($usuarioModelo->errors(), true));
                session()->setFlashdata('error', 'No se pudo modificar el usuario.');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Usuario actualizado correctamente.');
            return redirect()->to('/usuarios');
        }

        // En GET, mostrar el formulario con los datos actuales
        return view('usuarios/editar', ['usuario' => $usuario]);
    }

    public function obtenerUsuarios()
    {
        $modeloUsuario = new UsuarioModelo();
        $usuarios = $modeloUsuario->findAll();

        return $usuarios;
    }

    public function obtenerUsuarioPorId($idUsuario)
    {
        $modeloUsuario = new UsuarioModelo();
        $usuario = $modeloUsuario->find($idUsuario);

        if ($usuario === null) {
            return null; // O lanzar una excepción si prefieres
        }

        return $usuario;
    }

}