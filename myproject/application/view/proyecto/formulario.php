<div class="container">
	<form action="<?=URL . $data['destino']?>" method="post">
	<input type="text" name="cliente" value="<?php mostrarDatos($data['proyecto'],'cliente')?>">
	<input type="text" name="promocion" value="<?php mostrarDatos($data['proyecto'],'promocion')?>">
	<input type="text" name="fecha de inicio" value="<?php mostrarDatos($data['proyecto'],'fecha de inicio')?>">
	<input type="text" name="fecha de fin" value="<?php mostrarDatos($data['proyecto'],'fecha de fin')?>">
	<input type="text" name="fecha prevista" value="<?php mostrarDatos($data['proyecto'],'fecha prevista')?>">
	<input type="text" name="estado" value="<?php mostrarDatos($data['proyecto'],'estado')?>">
	</form>
</div>