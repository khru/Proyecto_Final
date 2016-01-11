<?php
	/**
	* Clase modelo de usuario
	*/
	class UsuarioModel
	{
		// Todos los métodos de la clase son estáticos

		// =================================================
		// MÉTODOS DE Obtención de información
		// =================================================
		public function getAll(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT persona.id as id, persona.nombre, persona.apellidos, persona.email, persona.direccion, provincia.nombre, nif, telefono, fecha_alta as 'fecha alta', cat_usu.nombre, usuario.nick as nick, carpeta, img,newsletter FROM usuario, persona, provincia, cat_usu WHERE usuario.id = persona.id AND provincia.id = persona.provincia AND persona.habilitado = 1 AND usuario.categoria = cat_usu.id";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		}// getAll()

		public static function getAllDisabled(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT persona.id as id, persona.nombre, persona.apellidos, persona.email, persona.direccion, provincia.nombre, nif, telefono, fecha_alta as 'fecha alta', cat_usu.nombre, usuario.nick as nick, carpeta, img,newsletter FROM usuario, persona, provincia, cat_usu WHERE usuario.id = persona.id AND provincia.id = persona.provincia AND persona.habilitado = 0 AND usuario.categoria = cat_usu.id";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		}// getAllDisabled()


		public static function getUser($usuario){
			$conn = Database::getInstance()->getDatabase();
			// creamos la consulta
			if(strpos($usuario, "@") === false){
				$ssql = "SELECT * FROM usuario WHERE nick = :nick";
			}else{
				$ssql = "SELECT * FROM usuario where id = (select id from persona where email = :nick)";
			}
			// Preparamos la consulta
			$query = $conn->prepare($ssql);
			$query->bindParam(':nick', $usuario);
			$query->execute();
			// Si hay alguna consulta afectada devolvemos los resultados sino devolvemos false
			if($query->rowCount() == 0){
				return false;
			}else {
				return $query->fetch();
			}
		}// getUser()

		// =========================================
		// Método de inserción de usuario
		// =========================================

		public static function insert(){
			// Primero tenemos que preparar un bloque try catch
			$errores = [];
			if ($_POST) {
				// Validamos todas las variables de $_POST
				$_POST = Validaciones::sanearEntrada($_POST);
				try {
					// empezamos la transacción
					$conn = DBPDO::getInstance()->getDatabase();
					$conn->beginTransaction();
					if (($error = PersonaModel::insert()) === true) {
						// Comprobaos los campos requeridos en la tabla
						if (isset($_POST["nick"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]) && isset($_POST["categoria"]) && isset($_POST["carpeta"]) && isset($_POST["img"])) {
							// Si cualquiera de los campos requeridos
							// Diese un error deberemos lanzar un rollback

							// validar Nick
							if (($err = Validaciones::validarNick($_POST["nick"])) !== true) {
								$errores["nick"] = $err;
							}

							// Validar contraseña
							if (($err = Validaciones::validarPassAlta($_POST["pass1"], $_POST["pass2"])) !== true) {
								$errores["pass"] = $err;
							}

							// Validar la categoría
							// En el formulario es un campo select
							// el cual tiene como value el valor de la BD
							// de forma que aqui solo hay que validar el id de la categria
							if (($err = Validaciones::validarPassId($_POST["categoria"])) !== true) {
								$errores["categoria"] = $err;
							} else {
								// comprobamos que dicho id exista en la base de datos
								// Sino lanzamos un error
								try {
									$conn = DBPDO::getInstance()->getDatabase();
									$ssql = "SELECT * FROM categoria WHERE id = :id";
									$prepare = $conn->prepare($ssql);
									$prepare->bindParam(":id", $id, PDO::PARAM_INT);
									$prepare->execute();
									if ($prepare->rowCount() === 1) {
										// si existe la preparo
										$campos[":provincia"] = $_POST["provincia"];
									} else{
										$errores["provincia"][] = "La provincia no existe";
									}
								} catch (PDOException $e) {
									return $errores['generic'][] = "Error en la base de datos";
								}
							}// fin de las comprobaciones de categoria

							if ($errores) {
								$conn->rollback();
								Validaciones::resultado($errores);
							}

						} else {
							// puesto que no tratamos de insertar
							// solamente personas sino que tenemos que insertar usuarios
							// que puedan logearse, si los campos del usuario no existen
							// directamente se hace un rollback
							$conn->rollback();
						}
					} elseif (($error = PersonaModel::insert()) === false) {
						$errores['generic'][] = "El usuario no se a insertado correctamente";
						// Si no se puede insertar el usuario hacemos un rollback
						$conn->rollback();
					} else {
						// Almacenamos los errores los errores
						$errores[] = $error;
						$conn->rollback();
						return Validaciones::resultado($errores);
					}


				// terminamos la transacción
				} catch (PDOException $e) {

				}
			} else {
				$errores['generic'][] = "No se han recivido datos";
				return Validaciones::resultado($errores);
			}

		}
	}
?>