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

	/**
	 * Método que normaliza el array para pasarle parametros, al bindeo
	 * @param  Array $params Parametros
	 * @return [type]         [description]
	 */
	private function normalizePrepareArray($params){
		foreach ($params as $key => $value) {
			$params[':' . $key] = $value;
			unset($params[$key]);
		}
		return $params;
	}

}