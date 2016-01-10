<p>¿Está seguro de que quiere habilitar este proyecto?</p>
<p>Este proyecto pasará al listado de proyectos habilitados</p>
<a href="<?= URL . 'proyectos/' ?>">
	<button type="button">Atrás</button>
</a><br/>
<a href="<?= URL . 'proyectos/habilitar/' . $data['proyecto']['id'] . '/true' ?>">
	<button type="button">Habilitar</button>
</a>