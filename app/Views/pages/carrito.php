<h2>Carrito de compras</h2>

<?php if (empty($carrito)): ?>
    <p>Tu carrito está vacío.</p>
<?php else: ?>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>
        <?php 
        $total = 0;
        foreach ($carrito as $item): 
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= esc($item['nombre']) ?></td>
            <td>$<?= esc($item['precio']) ?></td>
            <td><?= esc($item['cantidad']) ?></td>
            <td>$<?= $subtotal ?></td>
            <td><a href="<?= base_url('carrito/eliminar/' . $item['id']) ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>$<?= $total ?></strong></td>
            <td><a href="<?= base_url('carrito/vaciar') ?>" class="btn btn-warning btn-sm">Vaciar carrito</a></td>
        </tr>
    </table>
<?php endif; ?>