<?php
	/**
	*'clase PersonaModel, la cual permite que podamos utilizar métodos que necesitan
	* tanto clientes como usuarios'
	*/
	class PersonaModel
	{
		/**
		 * Método estatico de inserción de registros en persona
		 * + FECHA DE ALTA
		 * @return [type]              [description]
		 */
		public static function insert(){
			if (!$_POST) {
				// sino hay dolar post devolvemos
				$errores['generic'] = "No se han recibido datos";
				return Validaciones::resultado($errores);
			} else{
				// Validamos todas las variables de $_POST
				$_POST = Validaciones::sanearEntrada($_POST);
				// Comprobamos que los campos requeridos están sino error
				if (isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["email"])) {

						// variable del método para poder hacer un rapido bindeo de parametros y errores
						$errores["persona"];
						$campos = [];
						//  validamos el nombre
						if (($err = Validaciones::validarNombre($_POST["nombre"])) !== true) {
							$errores["personas"]["nombre"] = $err;
						} else {
							// si hay nombre lo ponemos en un array
							$campos[":nombre"] = $_POST["nombre"];
						}

						// Validamos los apellidos
						if (($err = Validaciones::validarApellidos($_POST["apellidos"])) !== true) {
							$errores["persona"]["apellidos"] = $err;
						} else {
							// si son validos los apellidos lo preparamos para el bindeo
							$campos[":apellidos"] = $_POST["apellidos"];
						}

						// validamos el email
						if (($err = Validaciones::validarEmail($_POST["email"])) !== true) {
							$errores["persona"]["email"] = $err;
						} else {
							// si es valido, preparamos para el bindeo
							$campos[":email"] = $_POST["email"];
						}

						if (isset($_POST["direccion"])) {
							// Si existe la dirección se valida
							if (($err = Validaciones::validarDireccion($_POST["direccion"])) !== true) {
								$errores["persona"]["direccion"] = $err;
							} else {
								// si existe, preparamos el bindeo
								$campos[":direccion"] = $_POST["direccion"];
							}
						}

						// si existe la provincia
						if (isset($_POST["provincia"])) {
							// se valida la provincia
							if (($err = Validaciones::validarId($_POST["provincia"])) !== true) {
								$errores["persona"]["provincia"] = $err;
							} else {
								// si existe la preparo
								$campos[":provincia"] = $_POST["provincia"];
							}
						}

						// si exite el nif
						if (isset($_POST["nif"])) {
							// se valida
							if (($err = Validaciones::validarNif($_POST["nif"])) !== true) {
								$errores["persona"]["nif"] = $err;
							} else {
								// si existe la preparo
								$campos[":nif"] = $_POST["nif"];
							}
						}

						// si existe telefono
						if (isset($_POST["telefono"])) {
							// se valida
							if (($err = Validaciones::validarTelefono($_POST["telefono"])) !== true) {
								$errores["persona"]["telefono"] = $err;
							} else {
								// si existe la preparo
								$campos[":telefono"] = $_POST["telefono"];
							}
						}
						// si exite newsletter
						if (isset($_POST["newsletter"])) {
							// se valida
							if (($err = Validaciones::validarTelefono($_POST["newsletter"])) !== true) {
								$errores["persona"]["newsletter"] = $err;
							} else {
								// si existe la preparo
								$campos[":newsletter"] = $_POST["newsletter"];
							}
						}

						// si no hay errores
						if (!$errores) {
							try{
								// Montamos las consultas
								$fields = "";
								$value = "";
								// $values = " :campo1 :campo2 ..."
								// $fields = "campo1, campo2,"
								foreach ($campos as $indice => $valor) {
									$values .= " " . $indice;
									$aux = mb_substr($indice, 1);
									$fields .= $aux . ",";
								}
								// le quito la última coma de más
								$fields = trim($fields, ",");
								// conexión a la base de datos
								$conn = DBPDO::getInstance()->getDatabase();
								// consulta de la base de datos
								$ssql = "INSERT INTO persona($fields) VALUES ($values)";
								// preparamos la consulta

								$query = $conn->prepare($ssql);
								// Hacemos el bindeo de parametros
								foreach ($campos as $indice => $valor) {
									if ($indice == ":newsletter" || $indice == ":provincia") {
										$query->bindParam($indice, $valor,PDO::PARAM_INT);
									} else {
										$query->bindParam($indice, $valor,PDO::PARAM_STR);
									}
								}

							} catch (PDOException $e){
								// devolvemos el error
								return "Error con la base de datos";
							}
						} else {
							// devolvemos los errores
							return Validaciones::resultado($errores);
						}

				} else {
					// si los campos requeridos no existen
					$errores['generic'] = "Los campos requeridos no han sido introducidos";
					return Validaciones::resultado($errores);
				}
			}
		}// insert()
	}
?>