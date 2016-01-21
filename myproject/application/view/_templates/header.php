<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DevWeb ● Desarrollo Web</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    
    <link rel="stylesheet" href="<?php echo URL; ?>css/devweb-theme.css"> <!-- Tema DevWeb -->
    <link rel="stylesheet" href="<?php echo URL; ?>iconfont/flaticon.css"> <!-- Iconos -->
    <link rel="stylesheet" href="<?php echo URL; ?>css/sequence-theme.basic.css"> <!-- slider -->

</head>
<body>
    
    <!-- // Cabecera -->
    <header>
        <a class ="logo" href="<?= URL ?>"><img src="<?php echo URL; ?>img/logo.png"></a>
        <a href="<?= URL . 'admin' ?>"><img src="<?php echo URL; ?>img/home.png" alt=""></a>
        <a class="med" href="<?= URL . 'cliente' ?>"><img src="<?php echo URL; ?>img/cliente.png" alt=""></a>
        <a class="max" href="<?= URL . 'proyecto' ?>"><img src="<?php echo URL; ?>img/proyecto.png" alt=""></a>
        <a class="med" href="<?= URL . 'servicio' ?>"><img src="<?php echo URL; ?>img/servicio.png" alt=""></a>
        <a class="med" href="<?= URL . 'promocion' ?>"><img src="<?php echo URL; ?>img/promocion.png" alt=""></a>
        <a class="max" href="<?= URL . 'articulo' ?>"><img src="<?php echo URL; ?>img/articulo.png" alt=""></a>
        <a class="max" href="<?= URL . 'usuario' ?>"><img src="<?php echo URL; ?>img/usuario.png" alt=""></a>
        <a href="<?= URL . 'rss' ?>"><img src="<?php echo URL; ?>img/rss.png" alt=""></a>
    </header>

    <?php HelperFunctions::comprobarSesion(); ?>
    <div class="first">
        Actualmente te encuentras identificado como <?= $_SESSION['usuario']['nick']?>
        <a href="<?= URL . 'acceso/logout'?>">Cerrar Sesion</a>
    </div>
