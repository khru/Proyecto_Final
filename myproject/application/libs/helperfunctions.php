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

	//Comprueba que haya una sesión válida
	public static function comprobarSesion(){
		session_start();
		$error = true;
		if($_SESSION){
			if(isset($_SESSION['usuario'])){
				$error = false;
				return true;
			}
		}
		if($error){
			header("Location: acceso/login". $_SERVER['PHP_SELF']);
		}
		
	}//comprobarSesion()

}