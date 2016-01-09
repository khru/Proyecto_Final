<?php
class Proyectos
{
	public function index(){
		HelperFunctions::comprobarSesion();
		$proyectos = proyectosModel::getAll();
		$archivos = array('generic/buscador', 'generic/listarelementos');
		View::renderMulti($archivos, 
			array('listar' => $proyectos,
				  'titulo' => 'Proyectos'
				));
	}
}