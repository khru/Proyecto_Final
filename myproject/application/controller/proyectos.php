<?php
class Proyectos
{
	public function index(){
		HelperFunctions::comprobarSesion();
		$proyectos = proyectosModel::getAll();
		$desabilitados = proyectosModel::getAllDisabled();
		$archivos = array('generic/buscador', 'generic/listarelementos', "generic/listardissabled");
		View::renderMulti($archivos, 
			array('listar'    => $proyectos,
				  'dissabled' => $desabilitados,
				  'titulo'    => 'Proyectos'
				));
	}
}