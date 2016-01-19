<?php


class PromocionModel
{

	public static function getAllPromociones(){

		$conn = Database::getInstance()->getDatabase();

		$ssql= "SELECT * FROM promo";

		$query = $conn->prepare($ssql);
		$query->execute();

		return $query->fetchAll();

	}

	public static function getPromocion($id){
		$conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM promo WHERE id = :id";
        $query = $conn->prepare($ssql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
	}



	public static function insertPromocion($datos){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "INSERT INTO promo (codigo,descripcion,unidades,porcentaje,fecha_inicio,fecha_fin) values
		 (:codigo,:descripcion,:unidades,:porcentaje,:fechainicio,:fechafin)"; 
		$query = $conn->prepare($ssql);
		$query->bindParam(':codigo',$datos['codigo']);
		$query->bindParam(':descripcion',$datos['descripcion']);
		$query->bindParam(':unidades',$datos['unidades']);
		$query->bindParam(':porcentaje',$datos['porcentaje']);
		$query->bindParam(':fechainicio',$datos['fechainicio']);
		$query->bindParam(':fechafin',$datos['fechafin']);
		$query->execute();
		return $query->rowCount();
	}



	public static function editPromocion($id,$datos){
		$errores = array();

		/*if(($err = Validaciones::validarId($id)) !== true){
			$errores = $err;
			return $errores;
		}*/
		
		$conn = Database::getInstance()->getDatabase();
		$ssql = "UPDATE promo SET codigo = :codigo, descripcion = :descripcion, unidades = :unidades,
		porcentaje = :porcentaje, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);
		$query->bindParam(':codigo',$datos['codigo']);
		$query->bindParam(':descripcion',$datos['descripcion']);
		$query->bindParam(':unidades',$datos['unidades']);
		$query->bindParam(':porcentaje',$datos['porcentaje']);
		$query->bindParam(':fechainicio',$datos['fechainicio']);
		$query->bindParam(':fechafin',$datos['fechafin']);
		$query->execute();
		return $query->rowCount();

		

	}


	public static function borrarPromocion($id){

		$conn = Database::getInstance()->getDatabase();
		$ssql = "UPDATE promo set habilitado = 0 where id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);
		$query->execute();
		return $query->rowCount();


	}

	public static function habilitarPromocion($id){

		$conn = Database::getInstance()->getDatabase();
		$ssql = "UPDATE promo set habilitado = 1 where id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);
		$query->execute();
		return $query->rowCount();


	}


}

	