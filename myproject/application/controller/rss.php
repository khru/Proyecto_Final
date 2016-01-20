<?php
Class Rss
{
	public function index(){
		$limit = 5;
		$init = 0;
		$articulos = ArticuloModel::getNewArticulos($limit, $init);
		View::renderSinCabeceras("rss/index", 
			array("articulos" => $articulos,
				  "titulo"	  => "RSS"
				  ));
	}
}