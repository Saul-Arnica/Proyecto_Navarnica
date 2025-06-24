<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVentaModelo extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id_detalle';
    protected $allowedFields = ['id_venta', 'id_producto', 'cantidad', 'precio_unitario'];
    protected $useTimestamps = false;
    protected $returnType = 'array';
}
