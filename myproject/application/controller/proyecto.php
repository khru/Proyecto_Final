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

			$_POST = HelperFunctions::sanear($_POST);
			
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

		$proyecto = ProyectoModel::getProyecto($id);

		if(!$_POST){
			
			
			$clientes = ClienteModel::getAll();
			$clienteselected = ClienteModel::getCliente($proyecto['cliente_id'])['nombre corporativo'];
			$promos = PromocionModel::getAllPromociones();
			$promoselected = PromocionModel::getPromocion($proyecto['promocion'])['codigo'];
			$estados = EstadoModel::getAll();
			$estadoselected = EstadoModel::getEstado($proyecto['estado_id'])['descripcion'];

			if($proyecto){
				$datos = array('destino' => 'proyecto/editar/'. $id,
					'clientelist' => $clientes, 'cliente_selected' => $clienteselected, 
					'proyecto' => $proyecto, 'submit' => 'Editar', 'promolist' => $promos,
					'promo_selected' => $promoselected, 'estadolist' => $estados,
					'estado_selected' => $estadoselected);

				View::render("proyecto/formulario", $datos);
			}else{
				header("Location: " . URL . "proyecto");
			}

		}else{

			$_POST = HelperFunctions::sanear($_POST);

			$errores = [];
			if(($err = Validaciones::validarFecha($_POST['fecha_de_inicio']))!== true){
				$errores['fecha_de_inicio'] = $err;
			}

			if(($err = Validaciones::validarFecha($_POST['fecha_prevista']))!== true){
				$errores['fecha_prevista'] = $err;
			}

			if($errores){
				$clientes = ClienteModel::getAll();
				$clienteselected = $_POST['cliente'];
				$promos = PromocionModel::getAllPromociones();
				$promoselected = $_POST['promocion'];
				$estados = EstadoModel::getAll();
				$estadoselected = $_POST['estado'];
				$datos = array('destino' => 'proyecto/editar',
					'promolist' => $promos, 'promo_selected' => $promoselected, 
					'estadolist' => $estados, 'estado_selected' => $estadoselected, 
					'clientelist' => $clientes, 'cliente_selected' => $clienteselected,
					'proyecto' => $proyecto, 'submit' => 'Editar',
					'errores' => $errores);
				View::render("proyecto/formulario", $datos);
			}else{
				ProyectoModel::update($_POST, $id);
				header("Location: " . URL . "proyecto");
			}	
		}
	}

	public function crear(){

		HelperFunctions::comprobarSesion();

		if(!$_POST){
			$clientes = ClienteModel::getAll();
			$promos = PromocionModel::getAllPromociones();
			$estados = EstadoModel::getAll();
			$datos = array('destino' => 'proyecto/crear', 'submit' => 'Crear',
				'promolist' => $promos, 'estadolist' => $estados, 'clientelist' => $clientes);
			View::render("proyecto/formulario", $datos);

		}else{

			$_POST = HelperFunctions::sanear($_POST);

			$errores = [];
			if(($err = Validaciones::validarFecha($_POST['fecha_de_inicio']))!== true){
				$errores['fecha_de_inicio'] = $err;
			}

			if(($err = Validaciones::validarFecha($_POST['fecha_prevista']))!== true){
				$errores['fecha_prevista'] = $err;
			}

			if($errores){
				$clientes = ClienteModel::getAll();
				$clienteselected = $_POST['cliente'];
				$promos = PromocionModel::getAllPromociones();
				$promoselected = $_POST['promocion'];
				$estados = EstadoModel::getAll();
				$estadoselected = $_POST['estado'];
				$datos = array('destino' => 'proyecto/crear', 'submit' => 'Crear',
					'promolist' => $promos, 'promo_selected' => $promoselected, 
					'estadolist' => $estados, 'estado_selected' => $estadoselected, 
					'clientelist' => $clientes, 'cliente_selected' => $clienteselected,
					'errores' => $errores);
				View::render("proyecto/formulario", $datos);
			}else{
				ProyectoModel::insert($_POST);
				header("Location: " . URL . "proyecto");
			}
		}
	}
}