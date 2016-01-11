<div class="container">

<form action="<?= URL . $data['destino']?>" method="post">
	<input type="search" name="buscar" value="<?= isset($data['ultima_busqueda']) ? $data['ultima_busqueda'] : "" ?>">
	<input type="submit" value="enviar">
</form>
</div>