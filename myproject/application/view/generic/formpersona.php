<div class="container">
<p>
	<label for "nombre">Nombre:</label>
	<input type="text" name="nombre" maxlength="25" required autofocus value="<?php (isset($_POST['nombre'])) ? HelperFunctions::mostrarDatos($data['cliente']['nombre']) : ""; ?>"><br>
	<?php (isset($data['errores']['nombre'])) ? HelperFunctions::mostrarErrores($data['errores']['nombre']) : ""; ?>
</p>

<p>
	<label for "apellidos">Apellidos:</label>
	<input type="text" name="apellidos" maxlength="40" required autofocus value="<?php (isset($_POST['apellidos'])) ?HelperFunctions::mostrarDatos($data['cliente']['apellidos']) : ""; ?>"><br>
	<?php (isset($data['errores']['apellidos'])) ? HelperFunctions::mostrarErrores($data['errores']['apellidos']) : ""; ?>
</p>

<p>
	<label for "email">Email:</label>
	<input type="email" name="email" maxlength="45" value="<?php (isset($_POST['email'])) ? HelperFunctions::mostrarDatos($data['cliente']['email']) : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['email'])) HelperFunctions::mostrarErrores($data['errores']['email']); ?>
</p>

<p>
	<label for "direccion">Direccion:</label>
	<input type="text" name="direccion" maxlength="70" value="<?php (isset($_POST['direccion'])) ? HelperFunctions::mostrarDatos($data['cliente']['direccion']) : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['direccion'])) HelperFunctions::mostrarErrores($data['errores']['direccion']); ?>
</p>

<p>
	<label for "provincia">Provincia:</label>
	<input type="text" name="provincia" maxlength="45" value="<?php (isset($_POST['provincia'])) ?HelperFunctions::mostrarDatos($data['cliente']['provincia']) : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['provincia'])) HelperFunctions::mostrarErrores($data['errores']['provincia']); ?>
</p>

<p>
	<label for "nif">DNI/NIE:</label>
	<input type="text" name="nif" maxlength="11" value="<?php (isset($_POST['nif'])) ? HelperFunctions::mostrarDatos($data['cliente']['nif']) : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['nif'])) HelperFunctions::mostrarErrores($data['errores']['nif']); ?>
</p>

<p>
	<label for "telefono">Telefono:</label>
	<input type="tlf" name="telefono" maxlength="15" value="<?php (isset($_POST['telefono'])) ?  HelperFunctions::mostrarDatos($data['cliente']['telefono']) : ""; ?>" required autofocus><br>
	<?php if (isset($data['errores']['telefono'])) HelperFunctions::mostrarErrores($data['errores']['telefono']); ?>
</p>

<p>
	<label for "newsletter">Suscripción a noticias:</label>
	<input type="checkbox" name="newsletter" value="newsletter" checked="
	<?php (isset($_POST['newsletter']) && $_POST['newsletter'] = 'On') ? 'checked' : "" ?>"><br>
	<?php if (isset($data['errores']['telefono'])) HelperFunctions::mostrarErrores($data['errores']['telefono']); ?>
</p>

<?php if(isset($_GET['id']) && !isset($_POST['id']) || isset($_POST['id']) && !empty($_POST)) : $_POST['id'] = $_GET['id'] ?>

<p>
	<input type="hidden" name="id" value="<?= $_POST['id'] ?>">
</p>

<?php endif ?>
