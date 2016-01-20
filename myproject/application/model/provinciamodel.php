<?php
	/**
	* Modelo de provincia
	*/
	class ProvinciaModel
	{
		/**
		 * Método que devuelve todos los nombre de las provincias
		 * @return Array Array asociativo con los resultados
		 */
		public static function getAll()
		{
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT nombre FROM provincia";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		}
	}
?>