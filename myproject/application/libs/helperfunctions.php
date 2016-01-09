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
		if($_SESSION){
			if(isset($_SESSION['nick'])){
				return true;
			}
		}
		header("Location: acceso/login");
	}//comprobarSesion()

}