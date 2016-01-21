<div class="container">
<h1>Artículos Deshabilitados</h1>
<?php foreach ($data['deshabilitados'] as $articulo): ?>
	<a href="<?= URL . 'articulo/mostrarArticulo/' . $articulo['url'] ?>"><?= $articulo['titulo']?></a>
	<a href="<?= URL . 'articulo/habilitar/' . $articulo['url'] ?>">Habilitar</a><br/><br/>
<?php endforeach ?>
</div>