<div class="sidebar-gestion">
    <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
    <a href="<?= base_url('admin/productos') ?>">Productos</a>
    <a href="<?= base_url('admin/categorias') ?>">Categorías</a>
    <a href="<?= base_url('admin/usuarios') ?>">Usuarios</a>
    <a href="<?= base_url('admin/consultas') ?>">Consultas</a>
</div>

<div class="content pt-5">
    <?= $this->renderSection('contenido') ?>
</div>