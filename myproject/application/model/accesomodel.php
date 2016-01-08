<?php
class AccesoModel
{
	public static function validarLogin($datos){
		$errores = array();

		$conn = Database::getInstance()->getDatabase();
		$nick = $datos['nick'];
		$passwd = ValidationFunctions::encriptarPasswd($datos['passwd']);
		$ssql = "SELECT * from usuario where nick = :nick";

		$query = $conn->prepare($ssql);
		$query->bindParam(':nick', $nick);
		$query->execute();

		if($query->rowCount() == 0){
			$errores[] = "Usuario o contraseña incorrectos";
		}else {
			$ssql2 = "SELECT * FROM usuario WHERE nick = :nick AND pass = :passwd";
			$query = $conn->prepare($ssql2);
			$query->bindParam(':nick', $nick);
			$query->bindParam(':passwd', $passwd);
			$query->execute();

			if($query->rowCount() == 0){
				$errores[] = "La contraseña introducida es incorrecta";
			}
		}
		if($errores){
			return $errores;
		}else{
			return true;
		}

	}
}