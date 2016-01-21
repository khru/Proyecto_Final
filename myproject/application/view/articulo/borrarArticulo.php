<p>¿Está seguro de que quiere borrar este artículo?</p>
<p>No se borrarán los datos pero dejará de aparecer disponible en el RSS</p>
<a href="<?= URL . 'articulo' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'articulo/borrar/' . $data['articulo']['url'] . '/true' ?>">
	<button type="button">Borrar</button>
</a>