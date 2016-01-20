<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?= isset($data['titulo']) ? $data['titulo'] : "DevWeb" ?></title>

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>

    <!-- navigation -->
    <div class="navigation">
        <a href="<?php echo URL . 'admin'; ?>">Home</a>
        <a href="<?php echo URL . 'usuario'; ?>">Usuarios</a>
        <a href="<?php echo URL . 'cliente'; ?>">Clientes</a>
        <a href="<?php echo URL . 'proyecto'; ?>">Proyectos</a>
        <a href="<?php echo URL . 'promocion'; ?>">Promociones</a>
        <a href="<?php echo URL . 'articulo'; ?>">Artículos</a>
        <a href="<?php echo URL . 'rss'; ?>">RSS</a>
    </div>
