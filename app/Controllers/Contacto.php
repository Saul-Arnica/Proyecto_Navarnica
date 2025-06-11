<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class Contacto extends BaseController
{
    public function informacionContacto()
    {
        return view('informacionContacto');
    }
    
    public function enviar()
    {
        // Validación (opcional)
        $validation = Services::validation();

        $validation->setRules([
            'nombre'  => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'mensaje' => 'required|min_length[10]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Acá podrías guardar el mensaje en base de datos o enviar por email

        session()->setFlashdata('success', '¡Consulta enviada con éxito!');
        return redirect()->to('/informacionContacto');
    }

}
