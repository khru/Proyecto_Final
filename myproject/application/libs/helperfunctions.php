<?php
class HelperFunctions
{
	public static function mostrarErrores($errores){
		foreach ($errores as $error) {
			echo $error . "<br/>";
		}
	}

	public static function encriptarPasswd($passwd){
		$passwd = md5($passwd);
		return $passwd;
	}

	public static function generarSesion(){
		if (session_id() === "") { 
			session_start(); 
		}
	}

	//Comprueba que haya una sesión válida y redirecciona al login
	public static function comprobarSesion($redireccion = true){
		self::generarSesion();
		if($_SESSION){
			if(isset($_SESSION['usuario'])){
				return true;
			}
		}
		if($redireccion){
			header("Location:" . URL . "acceso");
		}else{
			return false;
		}
		
	}//comprobarSesion()

}