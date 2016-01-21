<div class="container scroll">
	<h1>Proyectos</h1>
<?php if (isset($data['proyectos']) && (!empty($data['proyectos']))) :
	$claves = array_keys($data['proyectos'][0]);?>

<table border="1">
	<tr>
		<th>Id</th>
		<th>Cliente</th>
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>Teléfono</th>
		<th>NIF</th>
		<th>Email</th>
		<th>Provincia</th>
		<th>Promoción</th>
		<th>Fecha de Inicio</th>
		<th>Fecha de Fin</th>
		<th>Fecha Prevista</th>
		<th>Estado</th>
		<th colspan="2">Cambiar</th>
	</tr>
<?php foreach ($data['proyectos'] as $key => $value): ?>
	<tr>
		<td><?=$value['id']?></td>
		<td><a href="<?=URL . 'cliente/mostrarCliente/' . $value['cliente_id']?>"><?=$value['cliente']?></a></td>
		<td><?=$value['nombre']?></td>
		<td><?=$value['apellidos']?></td>
		<td><?=$value['telefono']?></td>
		<td><?=$value['nif']?></td>
		<td><?=$value['email']?></td>
		<td><?=$value['provincia']?></td>
		<td><a href="<?=URL . 'promocion/mostrarPromocion/' . $value['promo_id']?>"><?=$value['promocion']?></a></td>
		<td><?=$value['fecha de inicio']?></td>
		<td><?=$value['fecha de fin']?></td>
		<td><?=$value['fecha prevista']?></td>
		<td><?=$value['estado']?></td>
		<td><a href="<?=URL . 'proyecto/editar/' . $value['id']?>">Editar</a></td>
		<td><a href="<?=URL . 'proyecto/borrar/' . $value['id']?>">Borrar</a></td>
	</tr>
<?php endforeach ?>

</table>
<p>Total: <?=count($data['proyectos'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>