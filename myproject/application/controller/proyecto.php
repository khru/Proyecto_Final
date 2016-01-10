<?php
class Proyecto
{
	public function index(){
		HelperFunctions::comprobarSesion();

		$proyectos = ProyectoModel::getAll();
		$deshabilitados = ProyectoModel::getAllDisabled();

		$archivos = array("generic/buscador", "proyecto/listartodos",
			"proyecto/listardeshabilitados");

		$datos = array('titulo' => 'Proyectos', 'proyectos' => $proyectos,
			'deshabilitados' => $deshabilitados, 'destino' => 'proyecto/buscar');

		View::renderMulti($archivos, $datos);

	}

	public function borrar($id, $definitivo = false){
		HelperFunctions::comprobarSesion();

		if($definitivo){
			ProyectoModel::borrar($id);
			header("Location: ". URL . "proyectos");
		}else{
			if(!$_POST){
				$proyecto = ProyectoModel::getProyecto($id);
				$archivos = array("proyecto/listarproyecto", "proyecto/borrarproyecto");
				$datos = array('titulo' => 'Proyecto', 'proyecto' => $proyecto);

				View::renderMulti($archivos, $datos);
			}
		}
	}

	public function habilitar($id, $definitivo = false){
		HelperFunctions::comprobarSesion();

		if($definitivo){
			ProyectoModel::habilitar($id);
			header("Location: ". URL . "proyectos");
		}else{
			if(!$_POST){
				$proyecto = ProyectoModel::getProyecto($id);
				$archivos = array("proyecto/listarproyecto", "proyecto/habilitarproyecto");
				$datos = array('titulo' => 'Proyecto', 'proyecto' => $proyecto);

				View::renderMulti($archivos, $datos);
			}
		}
	}

	public function buscar(){
		HelperFunctions::comprobarSesion();
		if(!$_POST){
			header("Location: " . URL . "proyecto");
		}else{
			$proyectos = ProyectoModel::getSearch($_POST['buscar']);

			$archivos = array("generic/buscador","proyecto/listartodos");
			$datos = array('titulo' => 'Proyectos', 'proyectos' => $proyectos, 'destino' => 'proyecto/buscar');
			View::renderMulti($archivos, $datos);
		}
	}


}