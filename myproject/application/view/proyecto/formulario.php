<div class="container">
	<form action="<?=URL . $data['destino']?>" method="post">
		<label for="cliente">Cliente</label><br/>
		<input type="text" name="cliente" value="<?php mostrarDatos($data['proyecto'],'cliente')?>"><br/>
		<label for="cliente">Promoción</label><br/>
		<input type="text" name="promocion" value="<?php mostrarDatos($data['proyecto'],'promocion')?>"><br/>
		<label for="cliente">Fecha de Inicio</label><br/>
		<input type="date" name="fecha de inicio" value="<?php mostrarDatos($data['proyecto'],'fecha de inicio')?>"><br/>
		<label for="cliente">Fecha de Fin</label><br/>
		<input type="date" name="fecha de fin" value="<?php mostrarDatos($data['proyecto'],'fecha de fin')?>"><br/>
		<label for="cliente">Fecha Prevista</label><br/>
		<input type="date" name="fecha prevista" value="<?php mostrarDatos($data['proyecto'],'fecha prevista')?>"><br/>
		<label for="cliente">Estado</label><br/>
		<input type="text" name="estado" value="<?php mostrarDatos($data['proyecto'],'estado')?>"><br/>
	</form>
</div>