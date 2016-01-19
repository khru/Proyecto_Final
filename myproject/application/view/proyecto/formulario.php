<div class="container">
<h1>Proyecto</h1>
	<form action="<?=URL . $data['destino']?>" method="post">
		<label for="cliente">Cliente</label><br/>
		<input type="text" name="cliente" value="<?php if(isset($data['proyecto'])) HelperFunctions::mostrarDatos($data['proyecto'],'cliente')?>"><br/>
		<label for="cliente">Promoción</label><br/>
		<select name="promocion">
			<?php HelperFunctions::optionList($data['promolist'], 'codigo', true , $data['promo_selected']); ?>
		</select><br/>
		<label for="cliente">Fecha de Inicio</label><br/>
		<input type="date" name="fecha de inicio" value="<?php if(isset($data['proyecto'])) HelperFunctions::mostrarDatos($data['proyecto'],'fecha de inicio')?>"><br/>
		<label for="cliente">Fecha de Fin</label><br/>
		<input type="date" name="fecha de fin" value="<?php if(isset($data['proyecto'])) HelperFunctions::mostrarDatos($data['proyecto'],'fecha de fin')?>"><br/>
		<label for="cliente">Fecha Prevista</label><br/>
		<input type="date" name="fecha prevista" value="<?php if(isset($data['proyecto'])) HelperFunctions::mostrarDatos($data['proyecto'],'fecha prevista')?>"><br/>
		<label for="cliente">Estado</label><br/>
		<select name="estado">
			<?php HelperFunctions::optionList($data['estadolist'], 'descripcion', false , $data['estado_selected']); ?>
		</select><br>
		<input type="submit" value="<?=$data['submit']?>">
	</form>
	<br/>
	<a href="<?=URL . 'proyecto'?>">Atrás</a>
</div>