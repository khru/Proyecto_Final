<?php
Class Acceso
{
	public function index(){
		header("Location: acceso/login");
	}
	public function login($url = null){
		session_start();
		if($_SESSION && isset($_SESSION['usuario'])){
				
				View::render("acceso/sesionactiva");

		}else{

			if(!$_POST){
				View::clientRender("acceso/login");
			}else{
				$errores = array();

				$_POST = Validaciones::sanearEntrada($_POST);

				if(($err = Validaciones::validarNick($_POST['nick'])) !== true){
					$errores['nick'] = $err;
				}

				if(($err = Validaciones::validarPassLogin($_POST['passwd'])) !== true){
					$errores['passwd'] = $err;
				}

				if(!$errores){
					if(($err = AccesoModel::validarLogin($_POST)) !== true){
						$errores['login'] = $err;
						View::render("acceso/login", 
								array("errores" => $errores
								));
					}else{
						$usuario = $_POST['nick'];
						$datosUsuario = UsuariosModel::getUser($usuario);
						$_SESSION['usuario'] = $datosUsuario;

						if($url){
							header("Location: " . URL . $url);
						}else{
							header("Location: " . URL . "proyectos");
						}
					}

				}else{
					View::render("acceso/login", 
								array("errores" => $errores
								));
				}
			}
		}
		
	}

	public function logout(){
		session_start();
		session_destroy();
		View::render("acceso/logout");
	}
}