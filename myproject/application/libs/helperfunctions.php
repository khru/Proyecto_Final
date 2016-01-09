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
}