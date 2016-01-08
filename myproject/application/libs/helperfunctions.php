<?php
class HelperFunctions
{
	public static function mostrarErrores($errores){
		foreach ($errores as $error) {
			echo $error . "<br/>";
		}
	}
}