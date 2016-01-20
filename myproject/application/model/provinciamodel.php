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

		public static function getProvinciaBynombre($nombre)
		{
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT nombre FROM provincia WHERE nombre = :nombre";
			$query = $conn->prepare($ssql);
			$query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$query->execute();
			if ($query->rowCount() === 0) {
				return false;
			}
			return true;
		}
	}
?>