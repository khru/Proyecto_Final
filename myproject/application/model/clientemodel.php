<?php
	class ClienteModel
	{
		public static function getAll(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT cliente.id, persona.nombre, apellidos,
			 nombre_corporativo as 'nombre corporativo', email, telefono, nif, direccion,
			 provincia.nombre as 'provincia', fecha_alta as 'fecha de alta', newsletter
			FROM cliente inner join persona on cliente.id = persona.id
			 inner join provincia on persona.provincia = provincia.id
			where persona.habilitado = 1 order by cliente.id";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		} // getAll()

		public static function getAllDisabled(){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT cliente.id, persona.nombre, apellidos,
			 nombre_corporativo as 'nombre corporativo', email, telefono, nif, direccion,
			 provincia.nombre as 'provincia', fecha_alta as 'fecha de alta', newsletter
			FROM cliente inner join persona on (cliente.id = persona.id)
			 inner join provincia on persona.provincia = provincia.id
			where persona.habilitado = 0 order by cliente.id";
			$query = $conn->prepare($ssql);
			$query->execute();
			return $query->fetchAll();
		} // getAllDisabled()

		public static function getCliente($id){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT cliente.id, persona.nombre, apellidos,
			 nombre_corporativo as 'nombre corporativo', email, telefono, nif, direccion,
			 provincia.nombre as 'provincia', fecha_alta as 'fecha de alta', newsletter
			FROM cliente inner join persona on (cliente.id = persona.id)
			 inner join provincia on persona.provincia = provincia.id
			where persona.id = :id";
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
			$ssql = "UPDATE persona SET habilitado = 1 WHERE id = :id";
			$query = $conn->prepare($ssql);
			$query->bindParam(':id', $id, PDO::PARAM_INT);
			
			if(!$query->execute()){
				$errores[] = "No se ha podido habilitar el cliente especificado";
			}

			if($errores){
				return $errores;
			}else return true;
			
		} // habilitar()

		public static function getByName($name){
			$conn = Database::getInstance()->getDatabase();
			$ssql = "SELECT * from cliente where nombre_corporativo = :nombre";
			$query = $conn->prepare($ssql);
			$query->bindParam(':nombre', $name, PDO::PARAM_INT);
			$query->execute();
			return $query->fetch();
		} // getByName()

		public static function getSearch($busqueda){
			$conn = Database::getInstance()->getDatabase();

			$busqueda = '%' . $busqueda . '%';
			
			$ssql = "SELECT cliente.id, persona.nombre, apellidos, nombre_corporativo
            , email, telefono, nif, direccion, provincia.nombre
             as 'provincia', fecha_alta, newsletter,habilitado
            FROM cliente inner join persona on (cliente.id = persona.id)
             inner join provincia on (persona.provincia = provincia.id)
            WHERE (cliente.nombre_corporativo like :busqueda OR persona.nombre
             like :busqueda OR apellidos like :busqueda OR telefono like :busqueda
             OR nif like :busqueda OR direccion like :busqueda OR fecha_alta like
             :busqueda OR persona.email like :busqueda OR provincia like :busqueda)
             order by id";

			$query = $conn->prepare($ssql);

			$query->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
			$query->execute();
			return $query->fetchAll();
		} // getSearch()

	} // ClienteModel
?>
