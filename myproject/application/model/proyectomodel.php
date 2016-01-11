<?php
class ProyectoModel
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

		$id = intval($id);
		
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT proyecto.id, cliente.nombre_corporativo as cliente, promocion, fecha_inicio as 'fecha de inicio',
		fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado, proyecto.habilitado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
		where proyecto.id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);
		$query->execute();

		if($query->rowCount() === 0){
			return false;
		}
		return $query->fetch();
	}

	public static function borrar($id){
		$errores = array();

		if(($err = Validaciones::validarId($id)) !== true){
			$errores = $err;
			return $errores;
		}
		
		$conn = Database::getInstance()->getDatabase();
		$ssql = "UPDATE proyecto SET habilitado = 0 WHERE id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);

		if(!$query->execute() || $query->rowCount() !== 1){
			$errores[] = "No se ha podido borrar el proyecto especificado";
		}

		if($errores){
			return $errores;
		}else return true;

	}

	public static function habilitar($id){
		$errores = array();
		
		$id = intval($id);

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

	public static function getSearch($busqueda){
		$conn = Database::getInstance()->getDatabase();

		$busqueda = '%' . $busqueda . '%';

		$ssql = "SELECT cliente.nombre_corporativo as cliente, persona.nombre as nombre, persona.apellidos as apellidos,
		persona.telefono as telefono, persona.nif as nif, persona.email as email, provincia.nombre as provincia, promocion,
		fecha_inicio as 'fecha de inicio', fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado,
		proyecto.habilitado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
					  inner join persona on (cliente.id = persona.id)
					  inner join provincia on (persona.provincia = provincia.id)
		where (cliente.nombre_corporativo like :busqueda OR persona.nombre like :busqueda OR persona.apellidos like :busqueda OR
		persona.telefono like :busqueda OR persona.nif like :busqueda OR persona.email like :busqueda OR provincia.nombre like :busqueda OR
		promocion like :busqueda OR fecha_inicio like :busqueda OR fecha_fin like :busqueda OR fecha_prevista like :busqueda OR estado like :busqueda
		)AND proyecto.habilitado = 1";

		$query = $conn->prepare($ssql);

		$query->bindParam(':busqueda', $busqueda);
		$query->execute();
		return $query->fetchAll();
	}
}