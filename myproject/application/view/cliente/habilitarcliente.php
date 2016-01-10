<p>¿Está seguro de que quiere habilitar este cliente?</p>
<p>Este cliente pasará al listado de clientes habilitados</p>
<a href="<?= URL . 'cliente/' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'cliente/habilitar/' . $data['cliente']['id'] . '/true' ?>">
	<button type="button">Habilitar</button>
</a>
