<div class="container">
<h1>Promocion</h1>
<?php $claves = array_keys($data['promocion']); ?>
	<table border="1" style="background:yellow">
		<tr>
<?php foreach ($claves as $key => $value) : ?>
			<th><?=$value?></th>
<?php endforeach ?>
		</tr>

		<tr>
<?php foreach ($data['promocion'] as $key => $value) : ?>
			<td><?=$value?></td>
<?php endforeach ?>
		</tr>

	</table>

	<br/><a href="<?= URL . 'promocion' ?>">
	<button type="button">Atrás</button>
</a>
</div>
