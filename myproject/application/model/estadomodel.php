<?php
class EstadoModel
{
	public static function getAll(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM estado";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function getEstado($id){

		$id = intval($id);
		
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM estado where id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);
		$query->execute();

		return $query->fetch();
	}
}