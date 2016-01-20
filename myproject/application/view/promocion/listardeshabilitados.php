<div class="container">
	<h1>Promociones deshabilitadas</h1>
<?php if (isset($data['deshabilitados']) && (!empty($data['deshabilitados']))) :
	$claves = array_keys($data['deshabilitados'][0]);?>

<table  border="1" style="background-color:gray">
	<tr>
		<td>Id</td>
		<td>Codigo</td>
		<td>Descripcion</td>
		<td>Unidades</td>
		<td>Porcentaje</td>
		<td>Fecha Inicio</td>
		<td>Fecha Fin</td>
		<td>Habilitado</td>
		<td colspan="2">Cambiar</td>
	</tr>
<?php foreach ($data['deshabilitados'] as $key => $value): ?>
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
		<td><a href="<?=URL . 'promocion/habilitarPromocion/' . $value['id']?>">Habilitar</a></td>
	</tr>
<?php endforeach ?>
	
</table>
<p>Total: <?=count($data['deshabilitados'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>