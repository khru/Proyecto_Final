<?php HelperFunctions::comprobarSesion(); ?>
    <div class="container">
        Actualmente te encuentras identificado como <?= $_SESSION['usuario']['nick']?>
        <a href="<?= URL . 'acceso/logout'?>">Cerrar Sesion</a>
    </div>
</body>
</html>
