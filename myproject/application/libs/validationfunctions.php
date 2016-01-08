<?php
class ValidationFunctions
{
	public static function validarExistencia($campo, $nombre){
		$errores = array();
		if(!isset($campo)){
			$errores[] = "El campo \"$nombre\" no ha sido recibido";
		}else if(empty($campo)){
			$errores[] = "El campo \"$nombre\" está vacío";
		}

		if($errores){
			return $errores;
		}else {
			return true;
		}

	}

	public static function sanearEntrada($array){
		foreach ($array as $clave => $valor) {
			$array[$clave] = htmlspecialchars($valor, ENT_QUOTES);
		}
		return $array;
	}


	public static function encriptarPasswd($passwd){

		return md5($passwd);
	}
}