<div class="container">
	<h1>Estados</h1>
<?php if (isset($data['estados']) && (!empty($data['estados']))) :
	$claves = array_keys($data['estados'][0]);?>

<table border="1">
	<tr>
		<td>Id</td>
		<td>Descripción</td>
		<td colspan="2">Cambiar</td>
	</tr>
<?php foreach ($data['estados'] as $key => $value): ?>
	<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['descripcion']?></td>
		<td><a href="<?=URL . 'estado/editar/' . $value['id']?>">Editar</a></td>
		<td><a href="<?=URL . 'estado/borrar/' . $value['id']?>">Borrar</a></td>
	</tr>
<?php endforeach ?>
	
</table>
<p>Total: <?=count($data['estados'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>