<p>¿Está seguro de que quiere borrar este proyecto?</p>
<p>No se borrarán los datos pero dejará de aparecer como proyecto habilitado</p>
<a href="<?= URL . 'proyectos' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'proyectos/borrar/' . $data['proyecto']['id'] . '/true' ?>">
	<button type="button">Borrar</button>
</a>