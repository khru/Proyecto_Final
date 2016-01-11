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
			try {
				$conn = Database::getInstance()->getDatabase();
				$conn->beginTransaction();


			} catch (PDOException $e){

			}
		}
	}
?>