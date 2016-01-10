<p>¿Está seguro de que quiere borrar este cliente?</p>
<p>No se borrarán los datos pero este cliente dejará de aparecer como persona habilitada</p>
<a href="<?= URL . 'cliente' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'cliente/borrar/' . $data['cliente']['id'] . '/true' ?>">
	<button type="button">Borrar</button>
</a>
