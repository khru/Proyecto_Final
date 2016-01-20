<div class="container">
	<form action="<?= URL . 'promocion/nuevaPromocion'?>" method="post">

		<?php if(isset($data['errores']['descripcion'])) HelperFunctions::mostrarErrores($data['errores']['descripcion'])?>
		<label for="descipcion">descripcion de la Promocion</label><br/>
		<input type="text" name="descripcion" value="<?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']?>"><br/><br/>
		
		<?php if(isset($data['errores']['unidades'])) HelperFunctions::mostrarErrores($data['errores']['unidades'])?>
		<label for="unidades">Unidades de la Promocion</label><br/>
		<input type="number" name="unidades" value="<?php if(isset($_POST['unidades'])) echo $_POST['unidades']?>"><br/><br/>
		
		<?php if(isset($data['errores']['porcentaje'])) HelperFunctions::mostrarErrores($data['errores']['porcentaje'])?>
		<label for="porcentaje">porcentaje de descuento de la Promocion</label><br/>
		<input type="number" name="porcentaje" value="<?php if(isset($_POST['porcentaje'])) echo $_POST['porcentaje']?>"><br/><br/>
		
		<?php if(isset($data['errores']['fecha_inicio'])) HelperFunctions::mostrarErrores($data['errores']['fecha_inicio'])?>
		<label for="fecha_inicio">fecha de inicio de la Promocion</label><br/>
		<input type="date" name="fecha_inicio" value="<?php if(isset($_POST['fecha_inicio'])) echo $_POST['fecha_inicio']?>"><br/><br/>
		
		<?php if(isset($data['errores']['fecha_fin'])) HelperFunctions::mostrarErrores($data['errores']['fecha_fin'])?>
		<label for="fecha_fin">fecha final de la Promocion</label><br/>
		<input type="date" name="fecha_fin" value="<?php if(isset($_POST['fecha_fin'])) echo $_POST['fecha_fin']?>"><br/><br/>
		<input type="submit" value="Enviar Promocion">
	</form>
</div>