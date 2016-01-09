<div class="container">
<?php if(isset($data['listar'])) :
	$claves = array_keys($data['listar'][0]);?>

<table border="1">
	<tr>
<?php 	foreach ($claves as $clave => $valor) : ;	//Se listan las cabeceras de la tabla?>
		
		<th><?=$valor?></th>

<?php 	endforeach ?>
	</tr>

<?php   foreach ($data['listar'] as $clave => $valor) : //Se listan los datos?>
	<tr>
		<?php foreach ($valor as $clave => $datos) : ?>
			
				<td><?=$datos?></td>
			
		<?php endforeach ?>
	</tr>
  <?php endforeach ?>
</table>

<?php else : echo "No hay datos que listar"; endif?>