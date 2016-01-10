<?php
	/**
	* Clase modelo de usuario
	*/
	class UserModel
	{
		// Todos los métodos de la clase son estáticos

		public function getAll(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT * FROM usuario, persona WHERE usuario.id = persona.id";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		}

		public static function getUser($usuario){
			$conn = Database::getInstance()->getDatabase();
			// creamos la consulta
			$ssql = "SELECT * FROM usuario WHERE nick = :nick";
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
		}
	}
?>
