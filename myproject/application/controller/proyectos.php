<?php
class Proyectos
{
	public function index(){
		$proyectos = proyectosModel::getAll();

		View::render("generic/listarelementos", 
			array('listar' => $proyectos,
				  'titulo' => 'Proyectos'
				));
	}
}