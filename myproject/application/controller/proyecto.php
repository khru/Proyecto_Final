<?php
class Proyecto
{
	public function index(){
		HelperFunctions::comprobarSesion();

		$proyectos = proyectosModel::getAll();
		$deshabilitados = proyectosModel::getAllDisabled();

		$archivos = array("proyecto/buscador", "proyecto/listartodos",
			"proyecto/listardeshabilitados");

		$datos = array('titulo' => 'Proyectos', 'proyectos' => $proyectos,
			'deshabilitados' => $deshabilitados);

		View::renderMulti($archivos, $datos);

	}

	public function borrar($id, $definitivo = false){
		HelperFunctions::comprobarSesion();

		if($definitivo){
			proyectosModel::borrar($id);
			header("Location: ". URL . "proyectos");
		}else{
			if(!$_POST){
				$proyecto = ProyectosModel::getProyecto($id);
				$archivos = array("proyecto/listarproyecto", "proyecto/borrarproyecto");
				$datos = array('titulo' => 'Proyecto', 'proyecto' => $proyecto);

				View::renderMulti($archivos, $datos);
			}
		}
	}

	public function habilitar($id, $definitivo = false){
		HelperFunctions::comprobarSesion();

		if($definitivo){
			proyectosModel::habilitar($id);
			header("Location: ". URL . "proyectos");
		}else{
			if(!$_POST){
				$proyecto = ProyectosModel::getProyecto($id);
				$archivos = array("proyecto/listarproyecto", "proyecto/habilitarproyecto");
				$datos = array('titulo' => 'Proyecto', 'proyecto' => $proyecto);

				View::renderMulti($archivos, $datos);
			}
		}
	}


}