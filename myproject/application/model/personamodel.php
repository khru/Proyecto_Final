<?php
	/**
	*'clase PersonaModel, la cual permite que podamos utilizar métodos que necesitan
	* tanto clientes como usuarios'
	*/
	class PersonaModel
	{
		public static function habilitar($id){
			$errores = [];
            if (($err = Validaciones::validarId($id)) !== true) {
                $errores["id"] = $err;
            } else {
                try {
                    $conn = Database::getInstance()->getDatabase();

                    $ssql = "UPDATE persona SET habilitado = 1 WHERE id = :id";
                    $query = $conn->prepare($ssql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                    if($query->rowCount() == 0){
                        $errores['id'] = "No se ha podido habilitar la persona especificada";
                    }
                    return Validaciones::resultado($errores);
                } catch (PDOException $e) {
                    throw new Exception("Error en la base de datos");
                }// fin de bloque TRY-CATCH
            }
        }// habilitar()

        /**
         * Método de deshabilitar a una persona
         * @param  Integer $id ID de la persona a deshabilitar
         * @return Array o ture    Devuelve True cuando pasa las validaciones y Un array cuando hay errores
         */
        public static function deshabilitar($id){
            $errores = [];
            if (($err = Validaciones::validarId($id)) !== true) {
                $errores["id"] = $err;
            } else {
                try {
                    $conn = Database::getInstance()->getDatabase();

                    $ssql = "UPDATE persona SET habilitado = 0 WHERE id = :id";
                    $query = $conn->prepare($ssql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                    if($query->rowCount() === 0){
                        $errores['id'] = "No se ha podido deshabilitar la persona especificada";
                    }
                    return Validaciones::resultado($errores);
                } catch (PDOException $e) {
                    throw new Exception("Error en la base de datos");
                }// fin de bloque TRY-CATCH
            }
        }// habilitar()

        /**
         * Metodo que comprueba si ese valor (unique) ya esta en la base de datos.
         * @param  string $campo Campo de la base de datos
         * @param  string $valor Valor a comprobar de ese campo
         * @return bool        Devuelve true si lo encuentra o false si no.
         */
        public static function comprobarUnique($campo, $valor){
            try {
                $conn = Database::getInstance()->getDatabase();

                $ssql = "select * from persona where $campo=:valor";
                $query = $conn->prepare($ssql);
                $query->bindParam(':valor', $valor, PDO::PARAM_STR);
                $query->execute();
                if(empty($query->fetch())){
                   return false;
                }
                return true;
            } catch (PDOException $e) {
                throw new Exception("Error en la base de datos");
            }
        }


		/**
		 * Método estatico de inserción de registros en persona
		 * + FECHA DE ALTA
		 * @return [type]              [description]
		 */
		public static function insert(){
			// Comprobamos que los campos requeridos están sino error
			if (isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["email"])) {
				// variable del método para poder hacer un rapido bindeo de parametros y errores
				$errores = [];
				$campos = [];
				//  validamos el nombre
				if (isset($_POST["nombre"])) {
					if (($err = Validaciones::validarNombre($_POST["nombre"])) !== true) {
						$errores["nombre"] = $err;
					} else {
						// si hay nombre lo ponemos en un array
						$campos[":nombre"] = $_POST["nombre"];
					}
				}

				if (isset($_POST["apellidos"])) {
					// Validamos los apellidos
					if (($err = Validaciones::validarApellidos($_POST["apellidos"])) !== true) {
						$errores["apellidos"] = $err;
					} else {
						// si son validos los apellidos lo preparamos para el bindeo
						$campos[":apellidos"] = $_POST["apellidos"];
					}
				}

				if (isset($_POST["email"])) {
					// validamos el email
					if (($err = Validaciones::validarEmail($_POST["email"])) !== true) {
						$errores["email"] = $err;
					} else {
						if(self::comprobarUnique("email", $_POST["email"]) === true){
							$errores["email"][] = "El email insertado ya está registrado.";
						} else {
							$campos[":email"] = $_POST["email"];
						}
					}
				}


				if (isset($_POST["direccion"])) {
					// Si existe la dirección se valida
					if (($err = Validaciones::validarDireccion($_POST["direccion"])) !== true) {
						$errores["direccion"] = $err;
					} else {
						// si existe, preparamos el bindeo
						$campos[":direccion"] = $_POST["direccion"];
					}
				}

				// si existe la provincia
				if (isset($_POST["provincia"])) {
					// se valida la provincia
					if (($err = provinciaModel::getProvinciaByNombre($_POST["provincia"])) !== true) {
						$errores["provincia"][] = "La provincia no existe";
					} else {
						$prov = ProvinciaModel::getProvinciaId($_POST["provincia"]);
						$campos[":provincia"] =  $prov[0]['id'];
					}
				}// si existe provincia

				// si exite el nif
				if (isset($_POST["nif"])) {
					// se valida
					if (($err = Validaciones::validarNif($_POST["nif"])) !== true) {
						$errores["nif"][] = "El DNI o NIF no cumple el formato.";
					} else {
						if(self::comprobarUnique("nif", $_POST["nif"]) === true){
							$errores["nif"][] = "El DNI o NIF insertado ya está registrado.";
						} else {
							$campos[":nif"] = $_POST["nif"];
						}
					}
				}
				// si existe telefono
				if (isset($_POST["telefono"])) {
					// se valida
					if (($err = Validaciones::validarTelefono($_POST["telefono"])) !== true) {
						$errores["telefono"] = $err;
					} else {
						// si existe la preparo
						$campos[":telefono"] = $_POST["telefono"];
					}
				}
				// si exite newsletter
				if (isset($_POST["newsletter"])) {
					// se valida
					if (($err = Validaciones::validarTelefono($_POST["newsletter"])) !== true) {
						$errores["newsletter"] = $err;
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
						$values = "";
						// $values = " :campo1 :campo2 ..."
						// $fields = "campo1, campo2,"
						foreach ($campos as $indice => $valor) {
							$values .= " " . $indice . ",";
							$aux = mb_substr($indice, 1);
							$fields .= $aux . ",";
						}
						// le quito la última coma de más
						$fields = trim($fields, ",");
						$values = trim($values, ",");
						// conexión a la base de datos
						$conn = Database::getInstance()->getDatabase();
						// consulta de la base de datos
						// Añadimos a la consulta la fecha de alta formateada
						$fecha = "'" . date("Y-m-d") . "'";
						$ssql = "INSERT INTO persona($fields, fecha_alta) VALUES ($values, $fecha)";
						// preparamos la consulta
						$query = $conn->prepare($ssql);
						$query->execute($campos);
						if ($query->rowCount() === 1) {
							return $conn->lastInsertId();
						}
						return false;

					} catch (PDOException $e){
						// Lanzamos una excepción a tratar en el controlador
						throw new Exception('Error con la base de datos');
					}
				} else {
					// devolvemos los errores
					return Validaciones::resultado($errores);
				}

			} else {
				// si los campos requeridos no existen
				$errores['generic'][] = "Los campos requeridos no han sido introducidos";
				return Validaciones::resultado($errores);
			}
		}// insert()

	}
?>