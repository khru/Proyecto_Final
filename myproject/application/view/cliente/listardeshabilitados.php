<div class="container">
<h1>Clientes Deshabilitados</h1>
<?php if(isset($data['deshabilitados']) && (!empty($data['deshabilitados']))) :
	$claves = array_keys($data['deshabilitados'][0]);?>

<table border="1" style="background-color:gray">
	<tr>
<?php 	foreach ($claves as $clave => $valor) : ;	//Se listan las cabeceras de la tabla?>
		
			<th><?=$valor?></th>

<?php 	endforeach ?>
			<th colspan="2">Cambiar</th>
	</tr>

<?php   foreach ($data['deshabilitados'] as $clave => $valor) : //Se listan los datos?>
	<tr>
		<?php foreach ($valor as $clave => $datos) : ?>
			
				<td><?=$datos?></td>
			
		<?php endforeach ?>
				<td><a href="#">Editar</a></td>
				<td><a href="<?=URL . 'cliente/habilitar/' . $valor['id']?>">Habilitar</a></td>
	</tr>
  <?php endforeach ?>
</table>
<p>Total: <?=count($data['deshabilitados'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>
