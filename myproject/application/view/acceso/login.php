<div class="first">
	<p>Usuario: luilliangelux    Email: luiscavero92@gmail.com    Contraseña: Admin123</p>
</div>
<!-- LA FUNCIÓN mostrarErrores INCLUYE UN SALTO DE LINEA PARA SEPARAR CADA ERROR -->
<div class="container">
<form action="<?= URL . 'acceso'?>" method="post">
	<?php if (isset($data['errores']['generic'])) HelperFunctions::mostrarErrores($data['errores']['generic']); ?>
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
</div>