<?php
class Proyectos
{
	public function index(){
		HelperFunctions::comprobarSesion();
		$proyectos = proyectosModel::getAll();
		$deshabilitados = proyectosModel::getAllDisabled();
		
		View::renderSinCabeceras("_templates/header", array('titulo' => 'Proyectos'));
		View::renderSinCabeceras("generic/buscador");
		View::renderSinCabeceras("generic/listarelementos", array(
			'listar' => $proyectos, 'subtitulo' => 'Proyectos'));
		View::renderSinCabeceras("generic/listarelementos", array(
			'listar' => $deshabilitados, 'subtitulo' => 'Proyectos Deshabilitados'));
		View::renderSinCabeceras("_templates/footer");
		
	}
}