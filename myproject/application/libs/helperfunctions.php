<?php
	class HelperFunctions
	{

		/**
		* Función que generá una cooki reciviendo 2 o 3 parametros,
		* esta función existe para darle más semantica a el código
		* @param  String $id        [Identificador de la cookie(como hacceder a ella)]
		* @param  String $contenido [description]
		* @param  type $expira    [cuando expira la cookie, por defecto 2 anios]
		*
		*/
		public static function generarCookie($id ,$contenido, $expira){
			if(!isset($expira)){
				$expira = time() + ((60*60*24*365)*2);
			}
			return setcookie($id, $contenido, $expira);
		}// generarCookie()

		public static function mostrarErrores($errores){
			foreach ($errores as $error) {
				echo $error . "<br/>";
			}
		}// mostrarErrores()

		public static function mostrarDatos($array, $clave){
			if(isset($array[$clave])){
				echo $array[$clave];
			}
		}

		public static function mostrarErroresArray($errores)
		{
			echo '<ul class="ul-error">';
			foreach ($errores as $array) {
				foreach ($array as $error) {
					foreach ($error as $error1) {
						echo '<li class="li-error">' .$error1 . "</li>";
					}
				}
			}
			echo "</ul>";
		}

		/**
		 * Método que encripta la contraseña
		 * @param  String $passwd Contraseña a cifrar
		 * @return Hash  contraseña cifrada
		 */
		public static function encriptarPasswd($passwd){
			$passwd = md5($passwd);
			return $passwd;
		}// encriptarPasswd()

		/**
		 * Método que crea una sesión si no la hay
		 */
		public static function generarSesion(){
			if (session_id() === "") {
				session_start();
			}
		}// generarSesion()

		/**
		 * Método que comprueba que haya una sesión válida y redirecciona al login
		 * @param  boolean $redireccion [description]
		 * @return [type]               [description]
		 */
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
		}// normalizePrepareArray()

		/**
	 * optionList(array, string)
	 * Genera código html para listar las opciones de un array
	 * @param  $array Array, el array con las opciones a listar
	 * @param  $selected String, el campo que debe de estar seleccionado
	 */
	public static function optionList($array, $clave, $void = true, $selected = null){
		if($void){ ?>
			<option value='ninguna'>Ninguna</option>
  <?php }
		foreach ($array as $key => $value) {
			if($selected){
				print_r($value[$clave] . $selected);
				if(strcmp(trim($value[$clave]), $selected) === 0){?>
					<option selected="selected" value='<?=$value[$clave]?>'><?=$value[$clave]?></option>;
		  <?php }else{?>
					<option value='<?=$value[$clave]?>'><?=$value[$clave]?></option>;
		  <?php }
			}else{ ?>
				<option value='<?=$value[$clave]?>'><?=$value[$clave]?></option>;
	  <?php }
		}
	}//optionList()

	//Genera la url de un artículo basándose en el título
	public static function generarUrl($titulo){
		$url = preg_replace("/[^a-zA-Z0-9!¡]/", '-', $titulo);
		$url = preg_replace("/[!¡]/", '', $url);
		$url = strtolower($url);
		return $url;
	}

		/**
	 * sanear(array)
	 * Sanea un array
	 * @param  $array Array a sanear
	 * @return $array el array saneado
	 */
	public static function sanear($array){
		foreach ($array as $key => $value) {
			$array[$key] = trim(strip_tags($value));
		}
		return $array;
	}// sanear()


}// fin de la clase
