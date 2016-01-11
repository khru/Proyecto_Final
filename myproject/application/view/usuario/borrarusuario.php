<p>¿Está seguro de que quiere borrar este usuario?</p>
<p>No se borrarán los datos pero dejará de aparecer como proyecto habilitado</p>
<a href="<?= URL . 'usuario' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'usuario/borrar/' . $data['usuario']['id'] . '/true' ?>">
	<button type="button">Borrar</button>
</a>