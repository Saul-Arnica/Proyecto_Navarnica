<?php

namespace App\Controllers;
use \App\Models\ConsultaModelo;
use Config\Services;

class Consulta extends BaseController
{

    public function obtenerConsultas()
    {
        $modeloConsulta = new ConsultaModelo();
        $consultas = $modeloConsulta->findAll();

        return $consultas;
    }

    public function altaConsulta()
    {
        if ($this->request->getMethod() === 'POST') {
            $consultaModelo = new ConsultaModelo();
            $validation = Services::validation();

            $validation->setRules([
                'nombre'  => 'required|min_length[3]',
                'email'   => 'required|valid_email',
                'mensaje' => 'required|min_length[10]'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $datos = [
                'id_usuario' => session()->get('id_usuario') ?? null,
                'nombre'     => $this->request->getPost('nombre'),
                'email'      => $this->request->getPost('email'),
                'asunto'     => $this->request->getPost('asunto'),
                'mensaje'    => $this->request->getPost('mensaje'),
                'fecha'      => date('Y-m-d H:i:s'),
                'estado'     => 'pendiente' // estado inicial por defecto
            ];

            if ($consultaModelo->insert($datos)) {
                // Enviar email
                $email = \Config\Services::email();

                $email->setFrom('tucuenta@gmail.com', 'Veterinaria Navarnica');
                $email->setTo($datos['email']); // destinatario: quien hizo la consulta
                $email->setSubject('Confirmación de consulta');
                $email->setMessage(
                    '<p>Hola <strong>' . esc($datos['nombre']) . '</strong>,</p>' .
                    '<p>Tu consulta fue recibida correctamente. Te responderemos a la brevedad.</p>' .
                    '<p><strong>Asunto:</strong> ' . esc($datos['asunto']) . '</p>' .
                    '<p><strong>Mensaje:</strong><br>' . nl2br(esc($datos['mensaje'])) . '</p>' .
                    '<hr><p>Veterinaria Navarnica</p>'
                );

                if (!$email->send()) {
                    log_message('error', 'Error al enviar email: ' . print_r($email->printDebugger(['headers']), true));
                    session()->setFlashdata('error', 'Consulta registrada, pero no se pudo enviar el correo.');
                } else {
                    session()->setFlashdata('success', '¡Consulta enviada con éxito!');
                }

                return redirect()->to('/informacionContacto');
            }


            return redirect()->to('/informacionContacto');
        }
        session()->setFlashdata('error', 'Error');
        return redirect()->to('/informacionContacto');
    }

    public function bajaConsulta($id)
    {
        $consultaModelo = new ConsultaModelo();

        if ($consultaModelo->delete($id)) {
            session()->setFlashdata('success', 'Consulta eliminada correctamente');
        } else {
            session()->setFlashdata('error', 'Error al eliminar la consulta');
        }

        return redirect()->to('gestion/consultas');
    }

    public function modificacionConsulta($id)
    {
        $consultaModelo = new ConsultaModelo();

        if ($this->request->getMethod() === 'POST') {
            $datos = [
                'nombre'  => $this->request->getPost('nombre'),
                'email'   => $this->request->getPost('email'),
                'asunto'  => $this->request->getPost('asunto'),
                'mensaje' => $this->request->getPost('mensaje'),
                'estado'  => $this->request->getPost('estado')
            ];

            if ($consultaModelo->update($id, $datos)) {
                session()->setFlashdata('success', 'Consulta actualizada correctamente');
            } else {
                session()->setFlashdata('error', 'Error al actualizar la consulta');
            }

            return redirect()->to('gestion/consultas');
        }

        $data['consulta'] = $consultaModelo->find($id);
        return view('consultas/modificacion', $data);
    }
    
    public function responderConsulta($idConsulta)
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado.');
            return redirect()->to('/login');
        }

        $consultaModelo = new \App\Models\ConsultaModelo();
        $email = \Config\Services::email();

        $consulta = $consultaModelo->find($idConsulta);


        if (!$consulta) {
            session()->setFlashdata('error', 'Consulta no encontrada.');
            return redirect()->to('/gestion/consultas');
        }

        if ($this->request->getMethod() === 'POST') {
            $respuesta = $this->request->getPost('respuesta');

            $consultaModelo->update($idConsulta, [
                'respuesta' => $respuesta,
                'estado'    => 'respondida'
            ]);

            // Enviar email
            $email->setFrom('navarnica2@gmail.com', 'Navarnica Navarro y Arnica');
            $email->setTo($consulta['email']);
            $email->setSubject('Respuesta a tu consulta: ' . $consulta['asunto']);
            $email->setMessage("
                Hola {$consulta['nombre']},<br><br>
                Gracias por tu consulta. Te respondemos a continuación:<br><br>
                <strong>Consulta:</strong><br>
                {$consulta['mensaje']}<br><br>
                <strong>Respuesta:</strong><br>
                {$respuesta}<br><br>
                Saludos,<br>
                El equipo de atención
            ");

            if ($email->send()) {
                session()->setFlashdata('success', 'Respuesta enviada por correo y guardada.');
            } else {
                session()->setFlashdata('error', 'La respuesta fue guardada, pero no se pudo enviar el correo.');
            }

            return redirect()->to('/gestion/consultas');
        }

        // Si es GET
        return view('templates/gestion-layout', [
            'title' => 'Responder Consulta - Navarnica',
            'content' => view('pages/gestion/respuestaConsulta', ['consulta' => $consulta])
        ]);
    }

    public function testEmail()
    {
        $email = \Config\Services::email();
        //PLBXX-6BUP7-6M7DT-M4XHR-HUJVB
        $email->setFrom('navarnica@outlook.com', 'Veterinaria Navarnica');
        $email->setTo('saulagustinarnica@outlook.com');
        $email->setSubject('Prueba de Email');
        $email->setMessage('<p>Este es un correo de prueba desde CodeIgniter 4 con Outlook SMTP.</p>');

        if (!$email->send()) {
            echo $email->printDebugger(['headers']);
            $email->printDebugger();
            echo "Error al enviar el correo";
            log_message('error', $email->printDebugger(['headers']));
        } else {
            echo "Correo enviado correctamente";
        }
    }

}