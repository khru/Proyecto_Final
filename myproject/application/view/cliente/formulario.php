	<h1>Información del Cliente</h1>
	<p>
		<label for "nombreCorp">Nombre Corporativo:</label>
		<input type="text" name="nombreCorp" size="50" maxlength="100" value="<?php
			if(isset($_POST['nombreCorp'])){HelperFunctions::mostrarDatos($data['persona'], 'nombreCorp');
			} elseif(isset($data['persona']['nombre corporativo'])){HelperFunctions::mostrarDatos($data['persona'], 'nombre corporativo');
			}?>" required autofocus><br>
		<?php if (isset($data['errores']['nombreCorp'])) HelperFunctions::mostrarErrores($data['errores']['nombreCorp']); ?>
	</p>

	<p>
		<input type="submit" name="persona" value="<?=$data['submit']?>">
	</p>
	</form>
</div>