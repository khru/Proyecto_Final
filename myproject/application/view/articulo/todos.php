<div class="container">
	<a href="<?= URL . 'articulo/nuevoArticulo/'?>">Nuevo artículo</a>
</div>
<div class="container">
<h1>Artículos</h1>
<?php foreach ($data['articulos'] as $articulo): ?>
	<a href="<?= URL . 'articulo/mostrarArticulo/' . $articulo['url'] ?>"><?= $articulo['titulo']?></a>
	<a href="<?= URL . 'articulo/borrar/' . $articulo['url'] ?>">Deshabilitar</a><br/><br/>
<?php endforeach ?>
</div>