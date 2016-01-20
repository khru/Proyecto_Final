<?php
class Estado
{
	public function index(){

		HelperFunctions::comprobarSesion();

		$estados = EstadoModel::getAll();
		$deshabilitados = EstadoModel::getAllDissabled();

		$archivos = array("estado/crearestado", "estado/listartodos",
			"estado/listardeshabilitados");

		$datos = array('titulo' => 'Estados', 'estados' => $estados,
			'deshabilitados' => $deshabilitados);

		View::renderMulti($archivos, $datos);

	}

	public function borrar($id, $definitivo = false){

		HelperFunctions::comprobarSesion();

		if(Validaciones::validarId($id) !== true){
			header("Location: ". URL . "estado");
		}

		if($definitivo === "true"){
			EstadoModel::borrar($id);
			header("Location: ". URL . "estado");


		}else{
			$estado = EstadoModel::getEstado($id);

			if(!$estado){
				header("Location: ". URL . "estado");
			}

			$archivos = array("estado/listarestado", "estado/borrarestado");
			$datos = array('titulo' => 'Estado', 'estado' => $estado);

			View::renderMulti($archivos, $datos);
		}
	}

	public function habilitar($id, $definitivo = false){

		HelperFunctions::comprobarSesion();

		if(Validaciones::validarId($id) !== true){
		
			header("Location: ". URL . "estado");
		}

		if($definitivo === "true"){
			EstadoModel::habilitar($id);
			header("Location: ". URL . "estado");

		}else{
			if(!$_POST){
				$estado = EstadoModel::getEstado($id);

				if(!$estado){
					header("Location: ". URL . "estado");
				}

				$archivos = array("estado/listarestado", "estado/habilitarestado");
				$datos = array('titulo' => 'estado', 'estado' => $estado);

				View::renderMulti($archivos, $datos);
			}
		}
	}

	public function editar($id){

		HelperFunctions::comprobarSesion();

		if(Validaciones::validarId($id) !== true){
			header("Location: ". URL . "estado");
		}

		$estado = EstadoModel::getEstado($id);

		if(!$_POST){

			if($estado){
				$datos = array('destino' => 'estado/editar/'. $id,
					'estado' => $estado, 'submit' => 'Editar');

				View::render("estado/formulario", $datos);
			}else{
				header("Location: " . URL . "estado");
			}

		}else{
			$errores = [];
			if(!isset($_POST['descripcion']) || empty($_POST['descripcion'])){
				$errores['descripcion'] = ['descripcion' => 'El campo es requerido'];
			}

			if($errores){
				
				$datos = array('destino' => 'estado/editar/' . $id,
					'estado' => $estado, 'submit' => 'Editar',
					'errores' => $errores);
				View::render("estado/formulario", $datos);

			}else{
				EstadoModel::update($_POST, $id);
				header("Location: " . URL . "estado");
			}	
		}
	}

	public function crear(){

		HelperFunctions::comprobarSesion();

		if(!$_POST){

			$datos = array('destino' => 'estado/crear/',
				'submit' => 'Crear');

			View::render("estado/formulario", $datos);


		}else{
			$errores = [];
			if(!isset($_POST['descripcion']) || empty($_POST['descripcion'])){
				$errores['descripcion'] = ['descripcion' => 'El campo es requerido'];
			}

			if($errores){
				
				$datos = array('destino' => 'estado/crear',
					'estado' => $estado, 'submit' => 'Crear',
					'errores' => $errores);
				View::render("estado/formulario", $datos);

			}else{
				EstadoModel::insert($_POST);
				header("Location: " . URL . "estado");
			}	
		}
	}
}