<?php if(!isset($data['provinciaSelected'])) $data['provinciaSelected'] = null;?>
<div class="container">
<h1>Información personal</h1>
<form action="<?=URL . $data['destino']?>" method="post" name="persona" enctype="multipart/form-data">
<p>
	<label for "nombre">Nombre:</label>
	<input type="text" name="nombre" maxlength="25" required autofocus value="<?php /*(isset($_POST['nombre'])) ?  HelperFunctions::mostrarDatos($data['persona'], 'nombre') : ""; */ ?>"><br>
	<?php (isset($data['errores']['nombre'])) ? HelperFunctions::mostrarErrores($data['errores']['nombre']) : ""; ?>
</p>

<p>
	<label for "apellidos">Apellidos:</label>
	<input type="text" name="apellidos" maxlength="40" required autofocus value="<?php (isset($_POST['apellidos'])) ?HelperFunctions::mostrarDatos($data['persona'], 'apellidos') : ""; ?>"><br>
	<?php (isset($data['errores']['apellidos'])) ? HelperFunctions::mostrarErrores($data['errores']['apellidos']) : ""; ?>
</p>

<p>
	<label for "email">Email:</label>
	<input type="email" name="email" maxlength="45" value="<?php (isset($_POST['email'])) ? HelperFunctions::mostrarDatos($data['persona'], 'email') : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['email'])) HelperFunctions::mostrarErrores($data['errores']['email']); ?>
</p>

<p>
	<label for "direccion">Direccion:</label>
	<input type="text" name="direccion" size="70" maxlength="70" value="<?php (isset($_POST['direccion'])) ? HelperFunctions::mostrarDatos($data['persona'], 'direccion') : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['direccion'])) HelperFunctions::mostrarErrores($data['errores']['direccion']); ?>
</p>

<p>
	<label for "provincia">Provincia:</label>
	<select name="provincia">
	<?php HelperFunctions::optionList($data['provincialist'], 'nombre', false , $data['provinciaSelected']); ?>	</select><br/>
</p>

<p>
	<label for "nif">DNI/NIE:</label>
	<input type="text" name="nif" maxlength="11" value="<?php (isset($_POST['nif'])) ? HelperFunctions::mostrarDatos($data['persona'], 'nif') : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['nif'])) HelperFunctions::mostrarErrores($data['errores']['nif']); ?>
</p>

<p>
	<label for "telefono">Telefono:</label>
	<input type="tlf" name="telefono" maxlength="15" value="<?php (isset($_POST['telefono'])) ?  HelperFunctions::mostrarDatos($data['persona'], 'telefono') : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['telefono'])) HelperFunctions::mostrarErrores($data['errores']['telefono']); ?>
</p>

<p>
	<label for "newsletter">Suscripción a noticias:</label>
	<input type="checkbox" name="newsletter" value="newsletter" <?php (isset($_POST['newsletter']) && $_POST['newsletter'] = 'On') ? 'checked' : '' ?>><br>
	<?php if (isset($data['errores']['telefono'])) HelperFunctions::mostrarErrores($data['errores']['telefono']); ?>
</p>

<?php if (isset($_GET['id'])) : ?>
	<p>
		<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	</p>
<?php endif ?>