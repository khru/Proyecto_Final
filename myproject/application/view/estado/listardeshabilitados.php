<div class="container">
	<h1>Estados Deshabilitados</h1>
<?php if (isset($data['deshabilitados']) && (!empty($data['deshabilitados']))) :
	$claves = array_keys($data['deshabilitados'][0]);?>

<table border="1" style="background-color:gray">
	<tr>
		<td>Id</td>
		<td>Descripción</td>
		<td colspan="2">Cambiar</td>
	</tr>
<?php foreach ($data['deshabilitados'] as $key => $value): ?>
	<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['descripcion']?></td>
		<td><a href="<?=URL . 'estado/editar/' . $value['id']?>">Editar</a></td>
		<td><a href="<?=URL . 'estado/habilitar/' . $value['id']?>">Habilitar</a></td>
	</tr>
<?php endforeach ?>
	
</table>
<p>Total: <?=count($data['deshabilitados'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>