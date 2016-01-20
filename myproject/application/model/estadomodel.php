<?php
class EstadoModel
{
	public static function getAll(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM estado where habilitado = 1";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function getAllDissabled(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM estado where habilitado = 0";
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

	public static function getByDescripcion($descripcion){
		
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM estado where descripcion = :descripcion";
		$query = $conn->prepare($ssql);
		$query->bindParam(':descripcion', $descripcion);
		$query->execute();

		return $query->fetch();
	}

	public static function borrar($id){
		
		$id = intval($id);

		$conn = Database::getInstance()->getDatabase();

		$ssql = "UPDATE estado SET habilitado = 0 WHERE id = :id";

		$query = $conn->prepare($ssql);

		$query->bindParam(':id', $id);

		$query->execute();

		return $query->rowCount();

	}

	public static function habilitar($id){
		
		$id = intval($id);

		$conn = Database::getInstance()->getDatabase();

		$ssql = "UPDATE estado SET habilitado = 1 WHERE id = :id";

		$query = $conn->prepare($ssql);

		$query->bindParam(':id', $id);

		$query->execute();

		return $query->rowCount();
	}

		public static function update($data, $id){
		
		$id = intval($id);

		$descripcion = $data['descripcion'];

		$conn = Database::getInstance()->getDatabase();

		$ssql = "UPDATE estado SET descripcion = :descripcion WHERE id = :id";

		$query = $conn->prepare($ssql);

		$query->bindParam(':descripcion', $descripcion);
		$query->bindParam(':id', $id);

		$query->execute();

		return $query->rowCount();
	}

	public static function insert($data){

		$descripcion = $data['descripcion'];

		$conn = Database::getInstance()->getDatabase();

		$ssql = "INSERT INTO estado (descripcion) values (:descripcion)";

		$query = $conn->prepare($ssql);

		$query->bindParam(':descripcion', $descripcion);

		$query->execute();

		return $query->rowCount();
	}

}