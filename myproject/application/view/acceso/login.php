<div class="container"><p>Usuario: luilliangelux Contraseña: Admin123</p></div>
<form action="<?= URL . 'acceso/login'?>" method="post">
	<?php if (isset($data['errores']['login'])) HelperFunctions::mostrarErrores($data['errores']['login']); ?>
	<br/>
	<label for="nick">Usuario</label><br/>
	<?php if (isset($data['errores']['nick'])) HelperFunctions::mostrarErrores($data['errores']['nick']); ?>
	<br/>
	<input type="text" name="nick" value="<?= isset($_POST['nick']) ? $_POST['nick'] : '' ?>">
	<br/>
	<label for="nick">Contraseña</label><br/>
	<?php if (isset($data['errores']['passwd'])) HelperFunctions::mostrarErrores($data['errores']['passwd']); ?>
	<br/>
	<input type="password" name="passwd">
	<br/>
	<input type="submit" value="ENTRAR">
</form>