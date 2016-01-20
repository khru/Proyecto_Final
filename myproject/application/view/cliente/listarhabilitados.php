<div class="container">
<h1><?=$data['tituloListado']?></h1>
<?php if(isset($data['cliente']) && (!empty($data['cliente']))) :
		$data['habilitados'] = $data['cliente']; endif;
	if(isset($data['habilitados']) && (!empty($data['habilitados']))) :
	$claves = array_keys($data['habilitados'][0]);?>
<table border="1" style="background-color:white">
	<tr>
<?php 	foreach ($claves as $clave => $valor) : ;	//Se listan las cabeceras de la tabla?>
		
			<th><?=$valor?></th>

<?php 	endforeach ?>
			<th colspan="2">Cambiar</th>
	</tr>

<?php   foreach ($data['habilitados'] as $clave => $valor) : //Se listan los datos?>
	<tr>
		<?php foreach ($valor as $clave => $datos) : ?>
			
				<td><?=$datos?></td>
			
		<?php endforeach ?>
				<td><a href="#">Editar</a></td>
				<td><a href="<?=URL . 'cliente/borrar/' . $valor['id']?>">Borrar</a></td>
	</tr>
  <?php endforeach ?>
</table>
<p>Total: <?=count($data['habilitados'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>
