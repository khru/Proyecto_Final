<?php
class ProyectosModel
{
	public static function getAll(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM proyecto where habilitado = 1";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}
}