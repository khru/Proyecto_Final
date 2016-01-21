<div class="container">
	<h1>Promociones</h1>
<?php if (isset($data['promociones']) && (!empty($data['promociones']))) :
	$claves = array_keys($data['promociones'][0]);?>

<table border="1">
	<tr>
		<th>Id</th>
		<th>Codigo</th>
		<th>Descripcion</th>
		<th>Unidades</th>
		<th>Porcentaje</th>
		<th>Fecha Inicio</th>
		<th>Fecha Fin</th>
		<th>Habilitado</th>
		<th colspan="2">Cambiar</th>
	</tr>
<?php foreach ($data['promociones'] as $key => $value): ?>
	<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['codigo']?></td>
		<td><a href="<?=URL . 'promocion/mostrarPromocion/' . $value['id']?>"><?=$value['descripcion']?></a></td>
		<td><?=$value['unidades']?></td>
		<td><?=$value['porcentaje']?></td>
		<td><?=$value['fecha_inicio']?></td>
		<td><?=$value['fecha_fin']?></td>
		<td><?=$value['habilitado']?></td>
		<td><a href="<?=URL . 'promocion/editarPromocion/' . $value['id']?>">Editar</a></td>
		<td><a href="<?=URL . 'promocion/borrarPromocion/' . $value['id']?>">Borrar</a></td>
	</tr>
<?php endforeach ?>

</table>
<p>Total: <?=count($data['promociones'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>