	<h1>Información del Usuario</h1>
	<p>
		<label for "nick">Nick:</label>
		<input type="text" name="nick" maxlength="20" value="<?php (isset($_POST['nick'])) ? HelperFunctions::mostrarDatos($data['cliente']['nick']) : ""; ?>" required autofocus><br>
		<?php if (isset($data['errores']['nick'])) HelperFunctions::mostrarErrores($data['errores']['nick']); ?>
	</p>
	<p>
		<label for "pass">Password:</label>
		<input type="password" name="pass" maxlength="30" value="<?php (isset($_POST['pass'])) ? HelperFunctions::mostrarDatos($data['cliente']['pass']) : ""; ?>" required autofocus><br>
		<?php if (isset($data['errores']['pass'])) HelperFunctions::mostrarErrores($data['errores']['pass']); ?>
	</p>
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