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
		persona.telefono like :busqueda OR persona.nif like :busqueda OR persona.email like :busqueda OR promocion.codigo like :busqueda like :busqueda OR provincia.nombre like :busqueda OR
		promocion like :busqueda OR proyecto.fecha_inicio like :busqueda OR proyecto.fecha_fin like :busqueda OR fecha_prevista like :busqueda OR estado like :busqueda
		)AND proyecto.habilitado = 1";

		$query = $conn->prepare($ssql);

		$query->bindParam(':busqueda', $busqueda);
		$query->execute();
		return $query->fetchAll();
	}

	public static function insert($data){
	
		$conn = Database::getInstance()->getDatabase();
		$cliente = ClienteModel::getByName($data['cliente'])['id'];
		$promocion = $data['promocion'];
		$fecha_inicio = $data['fecha_de_inicio'];
		$fecha_fin = $data['fecha_de_fin'];
		$fecha_prevista = $data['fecha_prevista'];

		$estado = EstadoModel::getByDescripcion($data['estado'])['id'];

		$ssql = "INSERT INTO proyecto (cliente, ";

		if($promocion != 'ninguna'){
			$ssql .= "promocion, ";
		}

		$ssql .= "fecha_inicio, fecha_prevista, estado";

		if(!empty($fecha_fin)){
			$ssql .= ", fecha_fin";
		}

		$ssql .= ") values (:cliente, ";

		if($promocion != 'ninguna'){
			$ssql .= ":promocion, ";
		}

		$ssql .= ":fecha_inicio, :fecha_prevista, :estado";

		if(!empty($fecha_fin)){
			$ssql .= ", :fecha_fin";
		}

		$ssql .= ")";

		$query = $conn->prepare($ssql);

		$query->bindParam(':cliente', $cliente);

		if($promocion != 'ninguna'){
			$promocion = PromocionModel::getByCode($promocion)['id'];
			$query->bindParam(':promocion', $promocion);
		}
		
		$query->bindParam(':fecha_inicio', $fecha_inicio);
		$query->bindParam(':fecha_prevista', $fecha_prevista);
		$query->bindParam(':estado', $estado);

		if(!empty($fecha_fin)){
			$query->bindParam(':fecha_fin', $fecha_fin);
		}
		
		$query->execute();

		return $query->rowCount();
	}

	public static function update($data, $id){
	
		$conn = Database::getInstance()->getDatabase();

		$cliente = ClienteModel::getByName($data['cliente'])['id'];

		$promocion = $data['promocion'];

		$fecha_inicio = $data['fecha_de_inicio'];

		$fecha_fin = $data['fecha_de_fin'];

		$fecha_prevista = $data['fecha_prevista'];

		$estado = EstadoModel::getByDescripcion($data['estado'])['id'];

		$ssql = "UPDATE proyecto SET cliente = :cliente, fecha_inicio = :fecha_inicio,
		fecha_prevista = :fecha_prevista, estado = :estado";

		if($promocion != 'ninguna'){
			$ssql .= ", promocion = :promocion";
		}

		if(!empty($fecha_fin)){
			$ssql .= ", fecha_fin = :fecha_fin";
		}

		$ssql .= ' WHERE id = :id';
		$query = $conn->prepare($ssql);

		$query->bindParam(':cliente', $cliente);
		$query->bindParam(':fecha_inicio', $fecha_inicio);
		$query->bindParam(':fecha_prevista', $fecha_prevista);
		$query->bindParam(':estado', $estado);
		$query->bindParam(':id', $id);

		if($promocion != 'ninguna'){
			$promocion = PromocionModel::getByCode($promocion)['id'];
			$query->bindParam(':promocion', $promocion);
		}
		
		if(!empty($fecha_fin)){
			$query->bindParam(':fecha_fin', $fecha_fin);
		}
		
		$query->execute();

		return $query->rowCount();
	}
}