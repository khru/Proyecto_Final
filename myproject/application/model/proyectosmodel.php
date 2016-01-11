<?php
class ProyectosModel
{
	public static function getAll(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT proyecto.id, cliente.nombre_corporativo as cliente, promocion, fecha_inicio as 'fecha de inicio',
		fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
		where proyecto.habilitado = 1";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function getAllDisabled(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT proyecto.id, cliente.nombre_corporativo as cliente, promocion, fecha_inicio as 'fecha de inicio',
		fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
		where proyecto.habilitado = 0";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function getProyecto($id){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT proyecto.id, cliente.nombre_corporativo as cliente, promocion, fecha_inicio as 'fecha de inicio',
		fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado, proyecto.habilitado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
		where proyecto.id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);
		$query->execute();
		return $query->fetch();
	}

	public static function borrar($id){
		$errores = array();
		$conn = Database::getInstance()->getDatabase();
		$ssql = "UPDATE proyecto SET habilitado = 0 WHERE id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);

		if(!$query->execute()){
			$errores[] = "No se ha podido borrar el proyecto especificado";
		}

		if($errores){
			return $errores;
		}else return true;

	}

	public static function habilitar($id){
		$errores = array();
		$conn = Database::getInstance()->getDatabase();
		$ssql = "UPDATE proyecto SET habilitado = 1 WHERE id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);

		if(!$query->execute()){
			$errores[] = "No se ha podido habilitar el proyecto especificado";
		}

		if($errores){
			return $errores;
		}else return true;

	}
}