<p>¿Está seguro de que quiere borrar este estado?</p>
<p>No se borrarán los datos pero dejará de aparecer como estado habilitado</p>
<a href="<?= URL . 'estado' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'estado/borrar/' . $data['estado']['id'] . '/true' ?>">
	<button type="button">Borrar</button>
</a>