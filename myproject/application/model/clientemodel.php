<?php
	class ClienteModel
	{
		public static function getAll(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT cliente.id, cliente.nombre_corporativo as cliente
			FROM cliente inner join persona on (cliente.id = persona.id) 
			where persona.habilitado = 1";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		} // getAll()

		public static function getAllDisabled(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT cliente.id, cliente.nombre_corporativo as cliente
			FROM cliente inner join persona on (cliente.id = persona.id)
			where persona.habilitado = 0";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		} // getAllDisabled()

		public static function getCliente($id){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT id, nombre_corporativo as cliente
			FROM cliente
			where id = :id";
			$query = $conn->prepare($ssql);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			$query->execute();
			return $query->fetch();
		} // getCliente()

		public static function borrar($id){
			$errores = array();
			$conn = Database::getInstance()->getDatabase();
			$ssql = "UPDATE persona SET habilitado = 0 WHERE id = :id";
			$query = $conn->prepare($ssql);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			
			if(!$query->execute()){
				$errores[] = "No se ha podido borrar el cliente especificado";
			}

			if($errores){
				return $errores;
			}else return true;
			
		} // borrar()

		public static function habilitar($id){
			$errores = array();
			$conn = Database::getInstance()->getDatabase();
			$ssql = "UPDATE proyecto SET habilitado = 1 WHERE id = :id";
			$query = $conn->prepare($ssql);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			
			if(!$query->execute()){
				$errores[] = "No se ha podido habilitar el cliente especificado";
			}

			if($errores){
				return $errores;
			}else return true;
			
		} // habilitar()
	} // ClienteModel
?>
