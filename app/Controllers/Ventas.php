<?php

namespace App\Controllers;

use App\Models\VentaModelo;
use App\Models\DetalleVentaModelo;
use App\Models\ProductoModelo;

class Ventas extends BaseController
{
    public function misCompras()
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Para ver tus compras, inicia sesión.');
            return redirect()->to('/login');
        }
        
        $idUsuario = session()->get('id_usuario');
        if (!$idUsuario) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }

        $ventaModel = new VentaModelo();
        $detalleModel = new DetalleVentaModelo();
        $productoModel = new ProductoModelo();

        $ventas = $ventaModel
            ->where('id_usuario', $idUsuario)
            ->orderBy('fecha_venta', 'DESC')
            ->findAll();

        foreach ($ventas as &$venta) {
            $detalles = $detalleModel->where('id_venta', $venta['id_venta'])->findAll();

            foreach ($detalles as &$detalle) {
                $producto = $productoModel->find($detalle['id_producto']);
                $detalle['nombre_producto'] = $producto ? $producto['nombre'] : 'Producto eliminado';
            }

            $venta['detalles'] = $detalles;
        }

        return view('templates/main-layout', [
            'title' => 'Mis Compras - Navarnica',
            'content' => view('pages/misCompras', ['ventas' => $ventas])
        ]);
    }
}
