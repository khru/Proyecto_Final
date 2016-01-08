<?php
class UsuariosModel
{
	public static function getUser($usuario){
		$conn = Database::getInstance()->getDatabase();

		$ssql = "SELECT * FROM usuario WHERE nick = :nick";

		$query = $conn->prepare($ssql);
		$query->bindParam(':nick', $usuario);
		$query->execute();

		if($query->rowCount() == 0){
			return false;
		}else {
			return $query->fetch();
		}
	}
}