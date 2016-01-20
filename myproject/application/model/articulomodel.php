<?php
class ArticuloModel
{
	public static function getArticulo($url){
		$conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM articulo WHERE url = :url";
        $query = $conn->prepare($ssql);
        $query->bindParam(':url', $url);
        $query->execute();
        return $query->fetch();
	}

	public static function getAllArticulos(){
		$conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM articulo";
        $query = $conn->prepare($ssql);
        $query->execute();
        return $query->fetchAll();
	}

	public static function nuevoArticulo($datos){
		$conn = Database::getInstance()->getDatabase();
		
		$titulo = $datos['titulo'];
		$cuerpo = $datos['cuerpo'];
		$url = HelperFunctions::generarUrl($datos['titulo']);
		$fecha = date('Y-m-d H:i:s');

		$ssql = "INSERT INTO articulo (titulo, cuerpo, url, fecha_publicacion) values (:titulo, :cuerpo, :url, :fecha)";
		$query = $conn->prepare($ssql);
		$query->bindParam(':titulo', $titulo);
		$query->bindParam(':cuerpo', $cuerpo);
		$query->bindParam(':url', $url);
		$query->bindParam(':fecha', $fecha);
        $query->execute();
	}

	public static function getNewArticulos($limit, $init = 0){
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * from articulo order by fecha_publicacion desc LIMIT :limit";
		$query = $conn->prepare($ssql);
		$query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
	}
}