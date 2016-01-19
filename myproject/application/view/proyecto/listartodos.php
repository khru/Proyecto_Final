<div class="container">
	<h1>Proyectos</h1>
<?php if (isset($data['proyectos']) && (!empty($data['proyectos']))) :
	$claves = array_keys($data['proyectos'][0]);?>

<table border="1">
	<tr>
		<td>Id</td>
		<td>Cliente</td>
		<td>Nombre</td>
		<td>Apellidos</td>
		<td>Teléfono</td>
		<td>NIF</td>
		<td>Email</td>
		<td>Provincia</td>
		<td>Promoción</td>
		<td>Fecha de Inicio</td>
		<td>Fecha de Fin</td>
		<td>Fecha Prevista</td>
		<td>Estado</td>
		<td colspan="2">Cambiar</td>
	</tr>
<?php foreach ($data['proyectos'] as $key => $value): ?>
	<tr>
		<td><?=$value['id']?></td>
		<td><a href="<?=URL . 'cliente/listarcliente/' . $value['cliente_id']?>"><?=$value['cliente']?></a></td>
		<td><?=$value['nombre']?></td>
		<td><?=$value['apellidos']?></td>
		<td><?=$value['telefono']?></td>
		<td><?=$value['nif']?></td>
		<td><?=$value['email']?></td>
		<td><?=$value['provincia']?></td>
		<td><a href="<?=URL . 'promociones/mostrarPromocion/' . $value['promo_id']?>"><?=$value['promocion']?></a></td>
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