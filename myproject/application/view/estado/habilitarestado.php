<?php if(isset($data['errores'])) HelperFunctions::mostrarErrores($data['errores']);?>
<p>¿Está seguro de que quiere habilitar este estado?</p>
<p>Este estado pasará al listado de estados habilitados</p>
<a href="<?= URL . 'estado/' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'estado/habilitar/' . $data['estado']['id'] . '/true' ?>">
	<button type="button">Habilitar</button>
</a>