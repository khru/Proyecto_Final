<div class="container">
<h1>Estado</h1>
<?php $claves = array_keys($data['estado']); ?>
	<table border="1" style="background:yellow">
		<tr>
<?php foreach ($claves as $key => $value) : ?>
			<th><?=$value?></th>
<?php endforeach ?>
		</tr>

		<tr>
<?php foreach ($data['estado'] as $key => $value) : ?>
			<td><?=$value?></td>
<?php endforeach ?>
		</tr>

	</table>
</div>
