<?php
class ProyectoModel
{
	public static function getAll(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT proyecto.id as id, cliente.id as cliente_id, cliente.nombre_corporativo as cliente, persona.nombre as nombre, persona.apellidos as apellidos,
		persona.telefono as telefono, persona.nif as nif, persona.email as email, provincia.nombre as provincia, promocion as promo_id, promo.codigo as promocion,
		proyecto.fecha_inicio as 'fecha de inicio', proyecto.fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado,
		proyecto.habilitado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
					  inner join persona on (cliente.id = persona.id)
					  inner join provincia on (persona.provincia = provincia.id)
					  left outer join promo on (proyecto.promocion = promo.id)
		where proyecto.habilitado = 1";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function getAllDisabled(){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT proyecto.id as id, cliente.id as cliente_id, cliente.nombre_corporativo as cliente, persona.nombre as nombre, persona.apellidos as apellidos,
		persona.telefono as telefono, persona.nif as nif, persona.email as email, provincia.nombre as provincia, promocion as promo_id, promo.codigo as promocion,
		proyecto.fecha_inicio as 'fecha de inicio', proyecto.fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado,
		proyecto.habilitado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
					  inner join persona on (cliente.id = persona.id)
					  inner join provincia on (persona.provincia = provincia.id)
					  left outer join promo on (proyecto.promocion = promo.id)
		where proyecto.habilitado = 0";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function getProyecto($id){

		$id = intval($id);
		
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT proyecto.id, cliente.id as cliente_id, cliente.nombre_corporativo as cliente, promocion, fecha_inicio as 'fecha de inicio',
		fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado, estado.id as estado_id, proyecto.habilitado
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
		
		$id = intval($id);

		$conn = Database::getInstance()->getDatabase();

		$ssql = "UPDATE proyecto SET habilitado = 0 WHERE id = :id";

		$query = $conn->prepare($ssql);

		$query->bindParam(':id', $id);

		$query->execute();

		return $query->rowCount();

	}

	public static function habilitar($id){
		
		$id = intval($id);

		$conn = Database::getInstance()->getDatabase();

		$ssql = "UPDATE proyecto SET habilitado = 1 WHERE id = :id";

		$query = $conn->prepare($ssql);

		$query->bindParam(':id', $id);

		$query->execute();

		return $query->rowCount();
	}

	public static function getSearch($busqueda){
		$conn = Database::getInstance()->getDatabase();

		$busqueda = '%' . $busqueda . '%';

		$ssql = "SELECT proyecto.id as id, cliente.id as cliente_id, cliente.nombre_corporativo as cliente, persona.nombre as nombre, persona.apellidos as apellidos,
		persona.telefono as telefono, persona.nif as nif, persona.email as email, provincia.nombre as provincia, promocion as promo_id, promo.codigo as promocion,
		proyecto.fecha_inicio as 'fecha de inicio', proyecto.fecha_fin as 'fecha de fin', fecha_prevista as 'fecha prevista', estado.descripcion as estado,
		proyecto.habilitado
		FROM proyecto inner join estado on (proyecto.estado = estado.id)
					  inner join cliente on (proyecto.cliente = cliente.id)
					  inner join persona on (cliente.id = persona.id)
					  inner join provincia on (persona.provincia = provincia.id)
					  left outer join promo on (proyecto.promocion = promo.id)
		where (cliente.nombre_corporativo like :busqueda OR persona.nombre like :busqueda OR persona.apellidos like :busqueda OR
		persona.telefono like :busqueda OR persona.nif like :busqueda OR persona.email like :busqueda OR provincia.nombre like :busqueda OR
		promocion like :busqueda OR proyecto.fecha_inicio like :busqueda OR proyecto.fecha_fin like :busqueda OR fecha_prevista like :busqueda OR estado like :busqueda
		)AND proyecto.habilitado = 1";

		$query = $conn->prepare($ssql);

		$query->bindParam(':busqueda', $busqueda);
		$query->execute();
		return $query->fetchAll();
	}

	public static function insert($data){
	
		$conn = Database::getInstance()->getDatabase();

		$cliente = ClienteModel::getByCode($data['cliente']);
		$promocion = $data['promocion'];
		$fecha_inicio = $data['fecha_inicio'];
		$fecha_fin = $data['fecha_fin'];
		$fecha_prevista = $data['fecha_prevista'];
		$estado = $data['estado'];

		$ssql = "INSERT INTO proyecto (cliente, ";

		if($promocion != 'ninguna'){
			$ssql .= "promocion, ";
		}

		$ssql .= "fecha_inicio, fecha_fin, estado";

		if(!empty($fecha_prevista)){
			$ssql .= ", fecha_prevista";
		}

		$ssql .= ") values (:cliente, ";

		if($promocion != 'ninguna'){
			$ssql .= ":promocion, ";
		}

		$ssql .= ":fecha_inicio, :fecha_fin, :estado";

		if(!empty($fecha_prevista)){
			$ssql .= ", :fecha_prevista";
		}

		$ssql .= ")";

		$query = $conn->prepare($ssql);

		$query->bindParam(':cliente', $cliente);

		if($promocion != 'ninguna'){
			$promocion = PromocionModel::getByCode($promocion);
			$query->bindParam(':promocion', $promocion);
		}
		
		$query->bindParam(':fecha_inicio', $fecha_inicio);
		$query->bindParam(':fecha_fin', $fecha_fin);
		$query->bindParam(':estado', $estado);

		if(!empty($fecha_prevista)){
			$query->bindParam(':fecha_prevista', $fecha_prevista);
		}
		
		$query->execute();

		return $query->rowCount();
	}
}