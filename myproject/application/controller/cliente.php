<?php
class Cliente
{
	public function index(){
		HelperFunctions::comprobarSesion();

		$habilitados = ClienteModel::getAll();
		$deshabilitados = ClienteModel::getAllDisabled();

		$archivos = array("cliente/nuevocliente", "generic/buscador", "cliente/listarhabilitados", 
			"cliente/listardeshabilitados");

		$datos = array('titulo' => 'Clientes', 'habilitados' => $habilitados, 
			'deshabilitados' => $deshabilitados, 'destino' => 'cliente/buscar',
			'tituloListado' => 'Clientes Habilitados');

		View::renderMulti($archivos, $datos);
		
	} // index()


	public function mostrarCliente($id){

        HelperFunctions::comprobarSesion();

        $cliente = ClienteModel::getCliente($id);

        $datos = array('cliente' => $cliente);

        View::render("cliente/listarcliente",$datos);
    }


	public function borrar($id, $definitivo = false){
		HelperFunctions::comprobarSesion();
		
		if($definitivo){
			ClienteModel::borrar($id);
			header("Location: ". URL . "cliente");
		}else{
			if(!$_POST){
				$cliente = ClienteModel::getCliente($id);
				$archivos = array("cliente/listarcliente", "cliente/borrarcliente");
				$datos = array('titulo' => 'Clientes', 'cliente' => $cliente);

				View::renderMulti($archivos, $datos);
			}
		}
	} // borrar()

	public function habilitar($id, $definitivo = false){
		HelperFunctions::comprobarSesion();
		
		if($definitivo){
			ClienteModel::habilitar($id);
			header("Location: ". URL . "cliente");
		}else{
			if(!$_POST){
				$cliente = ClienteModel::getCliente($id);
				$archivos = array("cliente/listarcliente", "cliente/habilitarcliente");
				$datos = array('titulo' => 'Clientes', 'cliente' => $cliente);
				View::renderMulti($archivos, $datos);
			}
		}
	} // habilitar()


	public function buscar(){
		HelperFunctions::comprobarSesion();

		if(!$_POST){
			header("Location: " . URL . "cliente");
		}else{
			$cliente = ClienteModel::getSearch($_POST['buscar']);

			$archivos = array("generic/buscador","cliente/listarhabilitados");
			$datos = array('titulo' => 'Clientes', 'cliente' => $cliente, 'destino' => 'cliente/buscar',
			 'tituloListado' => 'Clientes Encontrados');
			View::renderMulti($archivos, $datos);
		}
	} // buscar()

	public function registrar(){
		$errores = [];
		HelperFunctions::comprobarSesion();

		if(!$_POST){
			$provincias = ProvinciaModel::getAll();
			$archivos = array("generic/formpersona", "cliente/formulario");
			$datos = array('destino' => 'cliente/registrar', 'submit' => 'Insertar Cliente',
			 'provincialist' => $provincias, '');
			View::renderMulti($archivos, $datos);

		}else{
			if(!is_array($err = ClienteModel::insert()) && $err === true){
				header("Location: " . URL . "cliente");
			}
			$errores = $err;
			$provincias = ProvinciaModel::getAll();
			$provinciaSelected = $_POST['provincia'];
			$archivos = array("generic/formpersona", "cliente/formulario");
			$datos = array('destino' => 'cliente/registrar', 'submit' => 'Insertar Cliente',
			 'provincialist' => $provincias, 'provinciaSelected' => $provinciaSelected, 'persona' => $_POST,
			 'errores' => $errores, 'volver' => 'cliente/index');

			View::renderMulti($archivos, $datos);
		}
	}

		public function update($id){
		$errores = [];
		HelperFunctions::comprobarSesion();

		if(Validaciones::validarId($id) !== true){
			header("Location: ". URL . "cliente");
		}

		if(!$_POST){
			$cliente = ClienteModel::getCliente($id);
			$provincias = ProvinciaModel::getAll();
			$archivos = array("generic/formpersona", "cliente/formulario");
			$datos = array('destino' => 'cliente/update', 'submit' => 'Editar Cliente',
			 'provincialist' => $provincias, 'persona' => $cliente, 'errores' => $errores,
			 'volver' => 'cliente/index');
			View::renderMulti($archivos, $datos);
		}else{
			if(!is_array($err = ClienteModel::update()) && $err === true){
				header("Location: " . URL . "cliente");
			}
			$errores = $err;
			$provincias = ProvinciaModel::getAll();
			$provinciaSelected = $_POST['provincia'];
			$archivos = array("generic/formpersona", "cliente/formulario");
			$datos = array('destino' => 'cliente/update', 'submit' => 'Insertar Cliente',
			 'provincialist' => $provincias, 'provinciaSelected' => $provinciaSelected, 'persona' => $_POST,
			 'errores' => $errores, 'volver' => 'cliente/index');

			View::renderMulti($archivos, $datos);
		}
	} // update()

} // Cliente
