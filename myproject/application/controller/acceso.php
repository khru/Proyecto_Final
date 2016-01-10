<?php
Class Acceso
{
	public function index(){
		if(HelperFunctions::comprobarSesion(false)){

				View::render("acceso/sesionactiva");

		}else{

			if(!$_POST){
				View::clientRender("acceso/login");
			}else{

				if(($err = AccesoModel::validarLogin()) !== true){
					$datos = array("errores" => $err);
					View::clientRender("acceso/login", $datos);

				}else{
					HelperFunctions::generarSesion();

					$usuario = $_POST['nick'];
					$datosUsuario = UsuariosModel::getUser($usuario);

					$_SESSION['usuario'] = $datosUsuario;

					header("Location: " . URL . "admin");
				}
			}
		}
	}//index()

	public function logout(){
		HelperFunctions::generarSesion();
		session_destroy();
		View::clientRender("acceso/logout");
	}//logout()
}