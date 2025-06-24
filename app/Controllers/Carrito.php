<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProductoModelo;

class Carrito extends BaseController
{
    public function agregar()
    {
        $productoID = $this->request->getPost('id');
        $cantidad = (int)$this->request->getPost('cantidad');

        // Cargar producto desde base de datos
        $productoModel = new ProductoModelo();
        $producto = $productoModel->find($productoID);

        if (!$producto || !$producto['activo']) {
            return redirect()->back()->with('error', 'Producto no disponible.');
        }

        $carrito = session()->get('carrito') ?? [];

        if (isset($carrito[$productoID])) {
            $carrito[$productoID]['cantidad'] += $cantidad;
        } else {
            $carrito[$productoID] = [
                'id' => $producto['id_producto'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad
            ];
        }

        session()->set('carrito', $carrito);
        return redirect()->to('/carrito')->with('success', 'Producto agregado al carrito.');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito') ?? [];

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->set('carrito', $carrito);
            return redirect()->to('/carrito')->with('success', 'Producto eliminado del carrito.');
        }

        return redirect()->to('/carrito')->with('error', 'El producto no está en el carrito.');
    }

    public function vaciar()
    {
        if (session()->has('carrito')) {
            session()->remove('carrito');
        }

        return redirect()->to('/carrito')->with('success', 'Carrito vaciado.');
    }
}
