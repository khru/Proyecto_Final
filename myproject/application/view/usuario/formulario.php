	<h1>Información del Usuario</h1>
	<p>
		<label for "nick">Nick:</label>
		<input type="text" name="nick" maxlength="20" value="<?php (isset($_POST['nick'])) ? HelperFunctions::mostrarDatos($data['persona'],'nick') : ""; ?>" required autofocus><br>
		<!--<?php if (isset($data['errores']['nick'])) HelperFunctions::mostrarErrores($data['errores']['nick']); ?>-->
	</p>
	<p>
		<label for "pass1">Password:</label>
		<input type="password" name="pass1" maxlength="30" value="<?php (isset($_POST['pass1'])) ? HelperFunctions::mostrarDatos($data['persona'],'pass1') : ""; ?>" required autofocus><br>
		<!--?php if (isset($data['errores']['pass1'])) HelperFunctions::mostrarErrores($data['errores']['pass1']); ?>-->
	</p>
	<?php if($data['submit'] === "Crear") : ?>
	<p>
		<label for "pass2">Repetir password:</label>
		<input type="password" name="pass2" maxlength="30" value="<?php (isset($_POST['pass2'])) ? HelperFunctions::mostrarDatos($data['persona'],'pass2') : ""; ?>" required autofocus><br>
		<!--<?php if (isset($data['errores']['pass2'])) HelperFunctions::mostrarErrores($data['errores']['pass2']); ?>-->
	</p>

	<?php endif ?>
	<p>
		<label for "categoria">Categoria del usuario:</label>
		<select name="categoria">
		<?php HelperFunctions::optionList($data['categorialist'], 'nombre', false, isset($data['categoria_selected']) ? $data['categoria_selected'] : null)?>
		</select><br/>
	</p>
	<p><!-- fichero -->
		<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
		<label for="img">Imagen de perfil: (MAX: 2MB)</label>
		<input type="file" name="img" id="" accept="image/*" autofocus>
	</p>
	<p>
		<input type="submit" name="usuario" value="<?=$data['submit']?>">
	</p>

	</form>
</div>