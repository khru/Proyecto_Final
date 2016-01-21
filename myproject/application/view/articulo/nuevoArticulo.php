<div class="container">
	<form action="<?= URL . 'articulo/nuevoArticulo'?>" method="post">
	<?php if(isset($data['errores']['titulo'])) HelperFunctions::mostrarErrores($data['errores']['titulo'])?>
		<label for="titulo">Título del artículo</label><br/>
		<input type="text" name="titulo"><br/><br/>

	<?php if(isset($data['errores']['cuerpo'])) HelperFunctions::mostrarErrores($data['errores']['cuerpo'])?>
		<label for="cuerpo">Cuerpo del artículo</label><br/>
		<textarea name="cuerpo" cols="80" rows="40"></textarea><br/><br/>
		
		<input type="checkbox" name="publicar">Publicar en la web<br><br>

		<input type="submit" value="Enviar Artículo">
	</form>
</div>