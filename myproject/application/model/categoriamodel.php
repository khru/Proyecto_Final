<?php
	/**
	* Modelo que representa las categorías de un usuario
	*/
	class CategoriaModel
	{
		/**
		 * Método de obtención de todas las categorías
		 * @return Array Devuelve un array con toda la información de las categorias de usuarios
		 */
		public static function getAll()
		{
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT id, nombre, precio_hora  FROM cat_usu";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		}

		public static function getCategoriaByNombre($nombre)
		{
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT nombre FROM cat_usu WHERE nombre = :nombre";
			$query = $conn->prepare($ssql);
			$query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$query->execute();
			if ($query->rowCount() === 0) {
				return false;
			}
			return true;
		}

		public static function getCategoriaId($nombre)
		{
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT * FROM cat_usu WHERE nombre = :nombre";
			$query = $conn->prepare($ssql);
			$query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>