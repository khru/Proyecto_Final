<?php


class PromocionModel
{

	public static function getAllPromociones(){

		$conn = Database::getInstance()->getDatabase();

		$ssql= "SELECT * FROM promo where habilitado = 1";

		$query = $conn->prepare($ssql);
		$query->execute();

		return $query->fetchAll();

	}

	public static function getAllDeshabilitados(){

		$conn = Database::getInstance()->getDatabase();

		$ssql= "SELECT * FROM promo where habilitado = 0";

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
		 (:codigo,:descripcion,:unidades,:porcentaje,:fecha_inicio,:fecha_fin)"; 
		$query = $conn->prepare($ssql);
		$query->bindParam(':codigo',$datos['codigo']);
		$query->bindParam(':descripcion',$datos['descripcion']);
		$query->bindParam(':unidades',$datos['unidades']);
		$query->bindParam(':porcentaje',$datos['porcentaje']);
		$query->bindParam(':fecha_inicio',$datos['fecha_inicio']);
		$query->bindParam(':fecha_fin',$datos['fecha_fin']);
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
		$ssql = "UPDATE promo SET  descripcion = :descripcion, unidades = :unidades,
		porcentaje = :porcentaje, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id";
		$query = $conn->prepare($ssql);
		$query->bindParam(':id', $id);
		$query->bindParam(':descripcion',$datos['descripcion']);
		$query->bindParam(':unidades',$datos['unidades']);
		$query->bindParam(':porcentaje',$datos['porcentaje']);
		$query->bindParam(':fecha_inicio',$datos['fecha_inicio']);
		$query->bindParam(':fecha_fin',$datos['fecha_fin']);
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

	public static function getByCode($codigo){
		$conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM promo WHERE codigo = :codigo";
        $query = $conn->prepare($ssql);
        $query->bindParam(':codigo', $codigo);
        $query->execute();
        return $query->fetch();
	}


}

	