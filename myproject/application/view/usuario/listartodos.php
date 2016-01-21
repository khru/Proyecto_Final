<div class="container scroll">
	<h1>Usuarios</h1>
<?php if (isset($data['usuario']) && (!empty($data['usuario']))) :
	$claves = array_keys($data['usuario'][0]);?>

<table border="1">
	<tr>
		<td>Id</td>
		<td>Nombre</td>
		<td>Apellidos</td>
		<td>Email</td>
		<td>Dirección</td>
		<td>Provincia</td>
		<td>NIF</td>
		<td>Teléfono</td>
		<td>Fecha alta</td>
		<td>Categoría</td>
		<td>Nick</td>
		<td>Carpeta</td>
		<td>Img</td>
		<td>Newsletter</td>
		<td colspan="2">Cambiar</td>
	</tr>
<?php foreach ($data['usuario'] as $key => $value): ?>
	<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['nombre']?></td>
		<td><?=$value['apellidos']?></td>
		<td><?=$value['email']?></td>
		<td><?=$value['direccion']?></td>
		<td><?=$value['provincia']?></td>
		<td><?=$value['nif']?></td>
		<td><?=$value['telefono']?></td>
		<td><?=$value['fecha alta']?></td>
		<td><?=$value['categoria']?></td>
		<td><?=$value['nick']?></td>
		<td><?=$value['carpeta']?></td>
		<td><?=$value['img']?></td>
		<td><?=$value['newsletter']?></td>
		<td><a href="<?=URL . 'usuario/editar/' . $value['id']?>">Editar</a></td>
		<td><a href="<?=URL . 'usuario/borrar/' . $value['id']?>">Borrar</a></td>
	</tr>
<?php endforeach ?>

</table>
<p>Total: <?=count($data['usuario'])?></p>
<?php else : echo "No hay datos que listar"; endif?>
</div>