<?xml version="1.0" encoding="UTF-8" ?> <!-- Especificación XML y codificación -->
<rss version="2.0"> 						 <!-- Versión RSS -->
<channel>
	<!-- Referido al canal -->
	<title>RSS DEVWEB</title>
	<link><?= URL . "rss" ?></link>
	<description>Últimas noticias de nuestra web DEVWEB</description>

	<!-- Referido a un artículo -->

<?php foreach ($data['articulos'] as $articulo) :?>	
	<item>
		<title><?= $articulo['titulo']?></title>
		<link><?= URL . "articulo/mostrarArticulo/". $articulo['url']?></link>
		<description><?= substr($articulo['cuerpo'], 0, 200)?></description>
	</item>
<?php endforeach ?>

</channel>
</rss>