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
        <a href="<?php echo URL; ?>">home</a>
        <a href="<?php echo URL . 'acceso/login'; ?>">Entrar</a>
    </div>