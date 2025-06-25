<?php

namespace App\Controllers;

use App\Models\VentaModelo;
use App\Models\DetalleVentaModelo;
use App\Models\ProductoModelo;
use App\Models\UsuarioModelo;

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
    public function detalleCompra($idVenta)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('error', 'Para ver el detalle de la compra, inicia sesión.');
            return redirect()->to('/login');
        }

        $idUsuario = session()->get('id_usuario');
        if (!$idUsuario) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }

        $ventaModel = new VentaModelo();
        $detalleModel = new DetalleVentaModelo();
        $productoModel = new ProductoModelo();

        $venta = $ventaModel->find($idVenta);
        if (!$venta || $venta['id_usuario'] != $idUsuario) {
            session()->setFlashdata('error', 'Compra no encontrada o no autorizada.');
            return redirect()->to('/mis-compras');
        }

        $detalles = $detalleModel->where('id_venta', $idVenta)->findAll();

        foreach ($detalles as &$detalle) {
            $producto = $productoModel->find($detalle['id_producto']);
            $detalle['nombre_producto'] = $producto ? $producto['nombre'] : 'Producto eliminado';
        }

        return view('templates/main-layout', [
            'title' => 'Detalle de Compra - Navarnica',
            'content' => view('pages/detalleCompra', ['venta' => $venta, 'detalles' => $detalles])
        ]);
    }
    public function historialVentas()
    {
        if (!session()->get('logged_in') || session()->get('tipo_usuario') !== 'admin') {
            session()->setFlashdata('error', 'Acceso no autorizado, debes ser administrador para acceder a esta página.');
            return redirect()->to('/login');
        }

        $ventasModelo = new VentaModelo();

        $ventasModelo->select('ventas.*, usuarios.nombre AS nombre_usuario');
        $ventasModelo->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario');
        $ventasModelo->orderBy('fecha_venta', 'DESC');

        $ventas = $ventasModelo->findAll();

        return view('templates/gestion-layout', [
            'title' => 'Historial de Ventas - Navarnica',
            'content' => view('pages/gestion/gestionVentas', ['ventas' => $ventas])
        ]);
    }
}