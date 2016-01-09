<?php
class Proyectos
{
	public function index(){
		$proyectos = proyectosModel::getAll();
		$archivos = array('generic/buscador', 'generic/listarelementos');
		View::renderMulti($archivos, 
			array('listar' => $proyectos,
				  'titulo' => 'Proyectos'
				));
	}
}