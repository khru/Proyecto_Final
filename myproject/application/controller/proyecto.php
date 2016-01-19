<?php
class Proyecto
{
	public function index(){
		HelperFunctions::comprobarSesion();

		$proyectos = ProyectoModel::getAll();
		$deshabilitados = ProyectoModel::getAllDisabled();

		$archivos = array("proyecto/crearproyecto","generic/buscador", "proyecto/listartodos",
			"proyecto/listardeshabilitados");

		$datos = array('titulo' => 'Proyectos', 'proyectos' => $proyectos,
			'deshabilitados' => $deshabilitados, 'destino' => 'proyecto/buscar');

		View::renderMulti($archivos, $datos);

	}

	public function borrar($id, $definitivo = false){

		HelperFunctions::comprobarSesion();

		if(Validaciones::validarId($id) !== true){
			header("Location: ". URL . "proyecto");
		}

		if($definitivo === "true"){
			ProyectoModel::borrar($id);
			header("Location: ". URL . "proyecto");


		}else{
			$proyecto = ProyectoModel::getProyecto($id);

			if(!$proyecto){
				header("Location: ". URL . "proyecto");
			}

			$archivos = array("proyecto/listarproyecto", "proyecto/borrarproyecto");
			$datos = array('titulo' => 'Proyecto', 'proyecto' => $proyecto);

			View::renderMulti($archivos, $datos);
		}
	}

	public function habilitar($id, $definitivo = false){

		HelperFunctions::comprobarSesion();

		if(Validaciones::validarId($id) !== true){
		
			header("Location: ". URL . "proyecto");
		}

		if($definitivo === "true"){
			ProyectoModel::habilitar($id);
			header("Location: ". URL . "proyecto");

		}else{
			if(!$_POST){
				$proyecto = ProyectoModel::getProyecto($id);

				if(!$proyecto){
					header("Location: ". URL . "proyecto");
				}

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

			$archivos = array("proyecto/crearproyecto","generic/buscador","proyecto/listartodos");
			$datos = array('titulo' => 'Proyectos', 'proyectos' => $proyectos, 'destino' => 'proyecto/buscar',
						   'ultima_busqueda' => $_POST['buscar']);
			View::renderMulti($archivos, $datos);
		}
	}

	public function editar($id){

		HelperFunctions::comprobarSesion();

		if(Validaciones::validarId($id) !== true){
			header("Location: ". URL . "proyecto");
		}

		if(!$_POST){
			$proyecto = ProyectoModel::getProyecto($id);
			$promos = PromocionModel::getAllPromociones();
			$promoselected = PromocionModel::getPromocion($proyecto['promocion'])['codigo'];
			if($proyecto){
				$datos = array('destino' => 'proyecto/editar/'. $id, 
					'proyecto' => $proyecto, 'submit' => 'Editar', 'promolist' => $promos,
					'promo_selected' => $promoselected);
				View::render("proyecto/formulario", $datos);
			}else{
				header("Location: " . URL . "proyecto");
			}

		}else{
			ProyectoModel::update($id, $_POST);
		}
	}

	public function crear(){

		HelperFunctions::comprobarSesion();

		if(!$_POST){
			$promos = PromocionModel::getAllPromociones();
			$datos = array('destino' => 'proyecto/crear', 'submit' => 'Crear',
				'promolist' => $promos);
			View::render("proyecto/formulario", $datos);

		}else{
			ProyectoModel::insert($_POST);
		}
	}


}