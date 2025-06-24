<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProductoModelo;
use App\Models\VentaModelo;
use App\Models\DetalleVentaModelo;

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
    public function finalizar()
    {
        $carrito = session()->get('carrito') ?? [];
        $idUsuario = session()->get('id_usuario');

        if (empty($carrito)) {
            return redirect()->to('/carrito')->with('error', 'Tu carrito está vacío.');
        }

        if (!$idUsuario) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para finalizar la compra.');
        }

        $productoModel = new ProductoModelo();
        $ventaModel = new VentaModelo();
        $detalleModel = new DetalleVentaModelo();

        $totalVenta = 0;

        // Verificar stock y calcular total
        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['id']);

            if (!$producto || !$producto['activo']) {
                return redirect()->to('/carrito')->with('error', 'Un producto ya no está disponible.');
            }

            if ($producto['stock'] < $item['cantidad']) {
                return redirect()->to('/carrito')->with('error', "No hay stock suficiente para '{$producto['nombre']}'.");
            }

            // Calcular precio final con descuento (si aplica)
            $precioUnitario = $producto['precio'];
            if ($producto['descuento'] > 0) {
                $precioUnitario -= $precioUnitario * $producto['descuento'] / 100;
            }

            $totalVenta += $precioUnitario * $item['cantidad'];
        }

        // Insertar venta
        $idVenta = $ventaModel->insert([
            'id_usuario' => $idUsuario,
            'fecha_venta' => date('Y-m-d H:i:s'),
            'total' => $totalVenta,
            'estado' => 'pendiente'
        ]);

        // Insertar detalles y actualizar stock
        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['id']);
            $precioUnitario = $producto['precio'];
            if ($producto['descuento'] > 0) {
                $precioUnitario -= $precioUnitario * $producto['descuento'] / 100;
            }

            $detalleModel->insert([
                'id_venta' => $idVenta,
                'id_producto' => $producto['id_producto'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $precioUnitario
            ]);

            // Actualizar stock
            $productoModel->update($producto['id_producto'], [
                'stock' => $producto['stock'] - $item['cantidad']
            ]);
        }

        session()->remove('carrito');
        return redirect()->to('/carrito')->with('success', 'Compra registrada exitosamente.');
    }
}
