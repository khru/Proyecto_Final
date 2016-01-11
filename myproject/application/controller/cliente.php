<?php
class Cliente
{
	public function index(){
		HelperFunctions::comprobarSesion();

		$cliente = ClienteModel::getAll();
		$deshabilitados = ClienteModel::getAllDisabled();

		$archivos = array("cliente/buscador", "cliente/listartodos", 
			"cliente/listardeshabilitados");

		$datos = array('titulo' => 'Clientes', 'cliente' => $cliente, 
			'deshabilitados' => $deshabilitados);

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
				echo "hola";
				View::renderMulti($archivos, $datos);
			}
		}
	} // habilitar()

} // Cliente
