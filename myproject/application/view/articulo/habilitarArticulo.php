<?php if(isset($data['errores'])) HelperFunctions::mostrarErrores($data['errores']);?>
<p>¿Está seguro de que quiere habilitar este artículo?</p>
<p>Este artículo pasará al listado de artículos disponibles y aparecerá en el RSS</p>
<a href="<?= URL . 'articulo/' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'articulo/habilitar/' . $data['articulo']['url'] . '/true' ?>">
	<button type="button">Habilitar</button>
</a>