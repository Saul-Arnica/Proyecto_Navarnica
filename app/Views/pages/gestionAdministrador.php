<section>
    <h1>
        <?php
        echo '<pre>';
            var_dump(session()->get());
        echo '</pre>';
        ?>
        Gestión del Administrador
    </h1>

    <form action="<?= base_url('logout') ?>" method="get">
            <button class="btn btn-outline-primary btn-sm" type="submit">
                Deslogearse
            </button>
    </form>

</section>