<div class="container">
	<h1>Clientes</h1>
<?php if(isset($data['cliente']) && (!empty($data['cliente']))) :
	$claves = array_keys($data['cliente'][0]);?>

<table border="1">
	<tr>
<?php 	foreach ($claves as $clave => $valor) : ;	//Se listan las cabeceras de la tabla?>
		
			<th><?=$valor?></th>

<?php 	endforeach ?>
			<th colspan="2">Cambiar</th>
	</tr>

<?php   foreach ($data['cliente'] as $clave => $valor) : //Se listan los datos?>
	<tr>
		<?php foreach ($valor as $clave => $datos) : ?>
			
				<td><?=$datos?></td>
			
		<?php endforeach ?>
				<td><a href="#">Editar</a></td>
				<td><a href="<?=URL . 'cliente/borrar/' . $valor['id']?>">Borrar</a></td>
	</tr>
  <?php endforeach ?>
</table>
<p>Total: <?=count($data['cliente'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>
