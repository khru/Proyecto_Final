<div class="container">
	<h1>Proyectos</h1>
<?php if (isset($data['proyectos']) && (!empty($data['proyectos']))) :
	$claves = array_keys($data['proyectos'][0]);?>

<table border="1">
	<tr>
<?php 	foreach ($claves as $clave => $valor) : ;	//Se listan las cabeceras de la tabla?>

			<th><?=$valor?></th>

<?php 	endforeach ?>
			<th colspan="2">Cambiar</th>
	</tr>

<?php   foreach ($data['proyectos'] as $clave => $valor) : //Se listan los datos?>
	<tr>
		<?php foreach ($valor as $clave => $datos) : ?>

				<td><?=$datos?></td>

		<?php endforeach ?>
				<td><a href="<?=URL . 'proyecto/editar/' . $valor['id']?>">Editar</a></td>
				<td><a href="<?=URL . 'proyecto/borrar/' . $valor['id']?>">Borrar</a></td>
	</tr>
  <?php endforeach ?>
</table>
<p>Total: <?=count($data['proyectos'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>