<?php

namespace App\Controllers;
use \App\Models\CategoriaModelo; // Importamos el modelo categoria

class Categorias extends BaseController
{

    public function obtenerCategorias()
    {
        $modeloCategoria = new CategoriaModelo();
        $categorias = $modeloCategoria->findAll();

        return $categorias;
    }

    public function altaCategoria() {
        if ($this->request->getMethod() === 'POST') {
            
            $categoriaModelo = new CategoriaModelo();
                $reglas = [
                    'nombre' => 'required|min_length[3]|max_length[50]',
                    'descripcion' => 'required|min_length[8]|max_length[50]'
                ];

                if (!$this->validate($reglas)) {
                    session()->setFlashdata('error', 'Debes completar todos los campos correctamente.');
                    return redirect()->to('/gestion/categorias');
                }

                $datos = [
                    'nombre' => $this->request->getPost('nombre'),
                    'descripcion' => $this->request->getPost('descripcion'),
                ];
                $resultado = $categoriaModelo->insert($datos);

                if (!$resultado) {
                    log_message('error', 'Error en insert: ' . print_r($categoriaModelo->errors(), true));
                    session()->setFlashdata('error', 'Error al registrar la nueva categoria. Inténtalo nuevamente.');
                    return redirect()->to('/gestion/categorias');
                }

                session()->setFlashdata('success', 'Registro exitoso.');
                return redirect()->to('/gestion/categorias');
            }
        }
    public function bajaCategoria($idCategoria) 
    {
        $categoriaModelo = new CategoriaModelo();
        $categoria = $categoriaModelo->find($idCategoria);
        if ($categoria === null) {
            session()->setFlashdata('error', 'Categoría no encontrada.');
            return redirect()->back();
        }

        if (!$categoriaModelo->delete($idCategoria)) {
            session()->setFlashdata('error', 'Error al eliminar la categoría.');
            return redirect()->back();
        }
        session()->setFlashdata('success', 'Categoría eliminada exitosamente.');
        return redirect()->to('/gestion/categorias');
    }
    public function modificarCategoria($idCategoria) {

        $categoriaModelo = new CategoriaModelo();
        $categoria = $categoriaModelo->find($idCategoria);

        if ($categoria === null) {
            session()->setFlashdata('error', 'Categoria no encontrada.');
            return redirect()->back();
        }

        if ($this->request->getMethod() === 'POST') {

            // Reglas mínimas para validar si los campos están bien formados
            $reglas = [
                'nombre'    => 'permit_empty|min_length[3]|max_length[50]',
                'descripcion' => 'min_length[3]|max_length[50]'
            ];

            if (!$this->validate($reglas)) {
                session()->setFlashdata('error', 'Verifica los datos ingresados.');
                return redirect()->back()->withInput();
            }

            $datos = [];

            // Comparar campo por campo, si está presente, no vacío y diferente, agregarlo
            $campos = ['nombre', 'descripcion'];
            foreach ($campos as $campo) {
                $nuevoValor = $this->request->getPost($campo);
                if ($nuevoValor !== null && $nuevoValor !== '' && $nuevoValor != $categoria[$campo]) {
                    $datos[$campo] = $nuevoValor;
                }
            }

            if (empty($datos)) {
                session()->setFlashdata('info', 'No se realizaron cambios.');
                return redirect()->back();
            }

            if (!$categoriaModelo->update($idCategoria, $datos)) {
                log_message('error', 'Error al actualizar usuario: ' . print_r($categoriaModelo->errors(), true));
                session()->setFlashdata('error', 'No se pudo modificar el usuario.');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Categoria actualizado correctamente.');
            return redirect()->to('gestion/categorias');
        }

        // En GET, mostrar el formulario con los datos actuales
        return view('gestion/categorias', ['categoria' => $categoria]);
    }
}