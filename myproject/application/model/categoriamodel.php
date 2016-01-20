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
	}
?>