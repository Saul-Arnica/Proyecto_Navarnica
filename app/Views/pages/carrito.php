<section class="container p-4">
    <h2 class="text-center">Carrito de compras</h2>
    <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger">
                        <?= esc(session()->get('error')) ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->get('errors')): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session()->get('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->get('success')) ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->get('info')): ?>
                    <div class="alert alert-info">
                        <?= esc(session()->get('info')) ?>
                    </div>
                <?php endif; ?>
    <div class="container-fluid">
        <?php if (empty($carrito)): ?>
            <div>
                <p class="rounded p-4 fs-1">Tu carrito Vacío</p>
                <div class=" text-center">
                    <a class="btn boton-custom w-100" href="<?= base_url('catalogoProductos') ?>">Ver Productos</a>
                    <a class="btn btn-primary w-100" href="<?= base_url('misCompras') ?>">Historial de compras</a>
                </div>
            </div>

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
                    // Aplicar descuento si tiene
                    $precioFinal = $item['precio'];
                    if (isset($item['descuento']) && $item['descuento'] > 0) {
                        $precioFinal = $precioFinal - ($precioFinal * $item['descuento'] / 100);
                    }

                    $subtotal = $precioFinal * $item['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= esc($item['nombre']) ?></td>
                        <td>
                            <?php if (isset($item['descuento']) && $item['descuento'] > 0): ?>
                                <del>$<?= esc(number_format($item['precio'], 2)) ?></del><br>
                                <strong>$<?= esc(number_format($precioFinal, 2)) ?></strong>
                            <?php else: ?>
                                $<?= esc(number_format($item['precio'], 2)) ?>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($item['cantidad']) ?></td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                        <td><a href="<?= base_url('carrito/eliminar/' . $item['id']) ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                    <td>
                        <a href="<?= base_url('carrito/vaciar') ?>" class="btn btn-warning btn-sm">Vaciar carrito</a>
                        <a href="<?= base_url('carrito/finalizar') ?>" class="btn btn-success btn-sm">Finalizar compra</a>
                    </td>
                </tr>
            </table>
        <?php endif; ?>
    </div>
</section>