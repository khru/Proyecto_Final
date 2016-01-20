<div class="container">
<h1>Estado</h1>
	<form action="<?=URL . $data['destino']?>" method="post">
		
		<?php if(isset($data['errores']['descripcion'])) HelperFunctions::mostrarErrores($data['errores']['descripcion'])?>
		<label for="descripcion"></label><br>
		<input type="text" name="descripcion" value="<?php if(isset($data['estado'])) HelperFunctions::mostrarDatos($data['estado'],'descripcion')?>">

		<input type="submit" value="<?=$data['submit']?>">
	</form>
	<br/>
	<a href="<?=URL . 'estado'?>">Atrás</a>
</div>