<?php
class Cliente
{
	public function index(){
		HelperFunctions::comprobarSesion();

		$habilitados = ClienteModel::getAll();
		$deshabilitados = ClienteModel::getAllDisabled();

		$archivos = array("generic/buscador", "cliente/listarhabilitados", 
			"cliente/listardeshabilitados");

		$datos = array('titulo' => 'Clientes', 'habilitados' => $habilitados, 
			'deshabilitados' => $deshabilitados, 'destino' => 'cliente/buscar',
			'tituloListado' => 'Clientes Habilitados');

		View::renderMulti($archivos, $datos);
		
	} // index()

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
			 'tituloListado' => 'Clientes Encontrados <sub>(Incluye deshabilitados)</sub>');
			View::renderMulti($archivos, $datos);
		}
	} // buscar()

} // Cliente
