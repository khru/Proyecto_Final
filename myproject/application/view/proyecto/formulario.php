<div class="container">
<h1>Proyecto</h1>
	<form action="<?=URL . $data['destino']?>" method="post">
		<label for="cliente">Cliente</label><br/>
		<select name="cliente">
			<?php HelperFunctions::optionList($data['clientelist'], 'nombre corporativo', false , $data['cliente_selected']); ?>
		</select><br/>
		<label for="promocion">Promoción</label><br/>
		<select name="promocion">
			<?php HelperFunctions::optionList($data['promolist'], 'codigo', true , $data['promo_selected']); ?>
		</select><br/>

		<?php if(isset($data['errores']['fecha_de_inicio'])) HelperFunctions::mostrarErrores($data['errores']['fecha_de_inicio'])?>
		<label for="fecha_de_inicio">Fecha de Inicio(YYYY-MM-DD)</label><br/>
		<input type="date" name="fecha_de_inicio" value="<?php if(isset($data['proyecto'])) HelperFunctions::mostrarDatos($data['proyecto'],'fecha de inicio')?>"><br/>


		<label for="fecha_de_fin">Fecha de Fin(YYYY-MM-DD)</label><br/>
		<input type="date" name="fecha_de_fin" value="<?php if(isset($data['proyecto'])) HelperFunctions::mostrarDatos($data['proyecto'],'fecha de fin')?>"><br/>

		<?php if(isset($data['errores']['fecha_prevista'])) HelperFunctions::mostrarErrores($data['errores']['fecha_prevista'])?>
		<label for="fecha_prevista">Fecha Prevista(YYYY-MM-DD)</label><br/>
		<input type="date" name="fecha_prevista" value="<?php if(isset($data['proyecto'])) HelperFunctions::mostrarDatos($data['proyecto'],'fecha prevista')?>"><br/>

		<label for="estado">Estado</label><br/>
		<select name="estado">
			<?php HelperFunctions::optionList($data['estadolist'], 'descripcion', false , $data['estado_selected']); ?>
		</select><br>
		<input type="submit" value="<?=$data['submit']?>">
	</form>
	<br/>
	<a href="<?=URL . 'proyecto'?>">Atrás</a>
</div>