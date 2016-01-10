<div class="container">
<a href="<?=URL . 'proyecto/crear'?>">Crear un nuevo proyecto</a>
<br/><br/>
<form action="<?= URL . $data['destino']?>" method="post">
	<input type="search" name="buscar">
	<input type="submit" value="enviar">
</form>
</div>