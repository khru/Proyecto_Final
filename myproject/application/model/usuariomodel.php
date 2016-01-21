<?php
	/**
	* Clase modelo de usuario
	*/
	class UsuarioModel
	{
		// Todos los métodos de la clase son estáticos

		// =================================================
		// MÉTODOS DE obtención de información
		// =================================================
		/**
		 * Método que muestra todos los clientes
		 * @return Array
		 */
		public static function getAll(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT persona.id as id, persona.nombre, persona.apellidos, persona.email, persona.direccion, provincia.nombre, nif, telefono, fecha_alta as 'fecha alta', cat_usu.nombre, usuario.nick as nick, carpeta, img,newsletter FROM usuario, persona, provincia, cat_usu WHERE usuario.id = persona.id AND provincia.id = persona.provincia AND persona.habilitado = 1 AND usuario.categoria = cat_usu.id";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		}// getAll()

		/**
		 * Método de mostrar deshabiliado
		 * @return Array
		 */
		public static function getAllDisabled(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT persona.id as id, persona.nombre, persona.apellidos, persona.email, persona.direccion, provincia.nombre, nif, telefono, fecha_alta as 'fecha alta', cat_usu.nombre, usuario.nick as nick, carpeta, img,newsletter FROM usuario, persona, provincia, cat_usu WHERE usuario.id = persona.id AND provincia.id = persona.provincia AND persona.habilitado = 0 AND usuario.categoria = cat_usu.id";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		}// getAllDisabled()

		// [IMPLEMENTAR CONSULTA]
		public static function getSearch($busqueda){
		$conn = Database::getInstance()->getDatabase();

		$busqueda = '%' . $busqueda . '%';

		$ssql = "SELECT cliente.nombre_corporativo as cliente, persona.nombre as nombre, persona.apellidos as apellidos,
		persona.telefono as telefono, persona.nif as nif, persona.email as email, provincia.nombre as provincia, promocion,
		fecha_inicio as 'fecha de inicio', fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado,
		proyecto.habilitado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
					  inner join persona on (cliente.id = persona.id)
					  inner join provincia on (persona.provincia = provincia.id)
		where (cliente.nombre_corporativo like :busqueda OR persona.nombre like :busqueda OR persona.apellidos like :busqueda OR
		persona.telefono like :busqueda OR persona.nif like :busqueda OR persona.email like :busqueda OR provincia.nombre like :busqueda OR
		promocion like :busqueda OR fecha_inicio like :busqueda OR fecha_fin like :busqueda OR fecha_prevista like :busqueda OR estado like :busqueda
		)AND proyecto.habilitado = 1";

		$query = $conn->prepare($ssql);

		$query->bindParam(':busqueda', $busqueda);
		$query->execute();
		return $query->fetchAll();
	}

		/**
		 * Método que devuelve un usuario, en vase del nick o del email
		 * @param  String $usuario
		 * @return false | Array
		 */
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
		/**
		 * Método de inserción que recoge las variables de $_POST
		 * @return [type] [description]
		 */
		public static function insert(){
			// Primero tenemos que preparar un bloque try catch
			$errores = [];
			$campos = [];
			if ($_POST) {
				// Validamos todas las variables de $_POST
				$_POST = Validaciones::sanearEntrada($_POST);
					// empezamos la transacción
					$conn = Database::getInstance()->getDatabase();
					$conn->beginTransaction();
					if (($error = PersonaModel::insert()) && is_array(PersonaModel::insert())) {
						// Comprobaos los campos requeridos en la tabla
						if (isset($_POST["nick"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]) && isset($_POST["categoria"])) {
							// Si cualquiera de los campos requeridos
							// Diese un error deberemos lanzar un rollback

							// validar Nick
							if (isset($_POST["nick"])) {
								if (($err = Validaciones::validarNick($_POST["nick"])) === true) {
									// comprobamos que dicho nick exista en la base de datos
									// Sino lanzamos un error
									try {
										$conn = Database::getInstance()->getDatabase();
										$ssql = "SELECT * FROM usuario WHERE nick = :nick";
										$prepare = $conn->prepare($ssql);
										$prepare->bindParam(":nick", $_POST["nick"], PDO::PARAM_STR);
										$prepare->execute();
										if ($prepare->rowCount() === 1) {
											// si existe la preparo
											$errores["nick"][] = "El nick ya existe";
										} else{
											$campos[":nick"] = $_POST["nick"];
											// creamos la carpeta personal del usuario
											echo exec('PWD');
											if (Validaciones::crearDir($carpeta = exec('$PWD') . "$_POST[nick]")) {
												$campos[":carpeta"] = $carpeta;
											}
										}
									} catch (PDOException $e) {
										return $errores['generic'][] = "Error en la base de datos";
									}

								} else {
									$errores["nick"][] = $err;
								}
							}


							// Validar contraseña
							if (isset($_POST["pass1"]) && isset($_POST["pass1"])) {
								if (($err = Validaciones::validarPassAlta($_POST["pass1"], $_POST["pass2"])) !== true) {
									$errores["pass"] = $err;
								} else {
									$campos[":pass"] = $_POST["pass1"];
								}
							} else {
								$errores["pass"][] = "Una de las contraseñas o ambas no han sido introducidas";
							}

							if (isset($_POST["categoria"])) {

								// Validar la categoría
								// En el formulario es un campo select
								// el cual tiene como value el valor de la BD
								// de forma que aqui solo hay que validar el id de la categria
								if (($err = CategoriaModel::getCategoriaByNombre($_POST["categoria"])) !== true) {
									$errores["categoria"][] = "La categoría no existe";
								} else {
									$aux = CategoriaModel::getCategoriaId($_POST["categoria"]);
									$campos[":categoria"] = $aux[0]['id'];
								}// fin de las comprobaciones de categoria
							} else {
								$errores["categoria"][] = "La categoría no existe";
							}


							// Si hay errores los retornamos
							if ($errores) {
								$conn->rollback();
								return Validaciones::resultado($errores);
							} else {
								// Insertamos todos los valores
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
								$ssql = "INSERT INTO usuario($fields) VALUES ($values)";
								$query = $conn->prepare($ssql);
								echo "$ssql";
								/*foreach ($campos as $indice => $valor) {
									if ($indice == ":categoria") {
										$query->bindParam($indice, $valor,PDO::PARAM_INT);
									} else {
										$query->bindParam($indice, $valor,PDO::PARAM_STR);
									}
								}*/
								$query->execute($campos);
								$conn->commit();
							}

						} else {
							// puesto que no tratamos de insertar
							// solamente personas sino que tenemos que insertar usuarios
							// que puedan logearse, si los campos del usuario no existen
							// directamente se hace un rollback
							$conn->rollback();
							$errores['generic'][] = "No se han recivido los datos minimos requeridos";
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
			} else {
				$errores['generic'][] = "No se han recivido datos";
				return Validaciones::resultado($errores);
			}

		}
	}
?>