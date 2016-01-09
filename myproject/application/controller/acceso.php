<?php
Class Acceso
{
	public function login($url = null){
		if(!$_POST){
			View::render("acceso/login");
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
					$_SESSION[$usuario] = $datosUsuario;

					if($url){
						header("Location: " . URL . $url);
					}else{
						header("Location: " . URL . "acceso/perfil");
					}
				}

			}else{
				View::render("acceso/login", 
							array("errores" => $errores
							));
			}
		}
	}

	public function perfil(){
		echo "HOLA ESTE ES TU PERFIL";
	}
}