<?php
class AccesoModel
{
	public static function validarEntradaLogin(){
		$errores = [];

		if(!$_POST){
			$errores['generic'][] = "No he recibido datos";
			return Validaciones::resultado($errores);
		}

		$_POST = Validaciones::sanearEntrada($_POST);

		if(($err = Validaciones::validarNick($_POST['nick'])) !== true){
			$errores['nick'] = $err;
		}


		if(($err = Validaciones::validarPassLogin($_POST['passwd'])) !== true){
			$errores['passwd'] = $err;
		}

		return Validaciones::resultado($errores);
	}//validarEntradaLogin()


	public static function validarLogin(){
		$errores = [];
		
		if(($err = self::validarEntradaLogin()) !== true){
			$errores = $err;
		}

		if(!$errores){

			$conn = Database::getInstance()->getDatabase();
			
			$ssql = "SELECT * 
			from usuario inner join persona on (usuario.id = persona.id)
			where nick = :nick AND habilitado = 1";

			$nick = $_POST['nick'];

			$query = $conn->prepare($ssql);
			$query->bindParam(':nick', $nick);
			$query->execute();

			if($query->rowCount() == 0){

				$errores['nick'][] = "Usuario o contraseña incorrectos";

			}else {

				$ssql2 = "SELECT * FROM usuario WHERE nick = :nick AND pass = :passwd";

				$passwd = HelperFunctions::encriptarPasswd($_POST['passwd']);

				$query = $conn->prepare($ssql2);
				$query->bindParam(':nick', $nick);
				$query->bindParam(':passwd', $passwd);
				$query->execute();

				if($query->rowCount() == 0){
					$errores['passwd'][] = "La contraseña introducida es incorrecta";
				}
			}
		}

		return Validaciones::resultado($errores);
	}//validarLogin()
}