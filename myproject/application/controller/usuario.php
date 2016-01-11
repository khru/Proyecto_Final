<?php
	class Usuario {
		/**
		 * Método index del usuario
		 */
		public function index(){
			HelperFunctions::comprobarSesion();

			$usuario = UsuarioModel::getAll();
			$deshabilitados = UsuarioModel::getAllDisabled();

			$archivos = array("usuario/crearusuario","generic/buscador", "usuario/listartodos",
				"usuario/listardeshabilitados");

			$datos = array('titulo' => 'Usuario', 'proyectos' => $usuario,
				'deshabilitados' => $deshabilitados, 'destino' => 'usuario/buscar');

			View::renderMulti($archivos, $datos);

		}

		public function borrar($id, $definitivo = false){

			HelperFunctions::comprobarSesion();

			if(Validaciones::validarId($id) !== true){
				header("Location: ". URL . "usuario");
			}

			if($definitivo === "true"){
				UsuarioModel::borrar($id);
				header("Location: ". URL . "usuario");


			}else{
				if(!$_POST){
					$usuario = UsuarioModel::getProyecto($id);

					if(!$proyecto){
						header("Location: ". URL . "usuario");
					}

					$archivos = array("usuario/listarusuario", "proyecto/borrarusuario");
					$datos = array('titulo' => 'Usuario', 'usuario' => $usuario);

					View::renderMulti($archivos, $datos);
				}
			}
		}

		public function habilitar($id, $definitivo = false){

			HelperFunctions::comprobarSesion();

			if(Validaciones::validarId($id) !== true){
				header("Location: ". URL . "usuario");
			}

			if($definitivo === "true"){
				ProyectoModel::habilitar($id);
				header("Location: ". URL . "usuario");

			}else{
				if(!$_POST){
					$proyecto = ProyectoModel::getProyecto($id);

					if(!$proyecto){
						header("Location: ". URL . "usuario");
					}

					$archivos = array("usuario/listarusuario", "usuario/habilitarusuario");
					$datos = array('titulo' => 'Usuario', 'Usuario' => $usuario);

					View::renderMulti($archivos, $datos);
				}
			}
		}

		public function buscar(){
			HelperFunctions::comprobarSesion();

			if(!$_POST){
				header("Location: " . URL . "usuario");
			}else{
				$usuario = UsuarioModel::getSearch($_POST['buscar']);

				$archivos = array("usuario/crearusuario","generic/buscador","usuario/listartodos");
				$datos = array('titulo' => 'Usuarios', 'usuario' => $usuario, 'destino' => 'usuario/buscar',
							   'ultima_busqueda' => $_POST['buscar']);
				View::renderMulti($archivos, $datos);
			}
		}

		public function editar($id){

			HelperFunctions::comprobarSesion();

			if(Validaciones::validarId($id) !== true){
				header("Location: ". URL . "usuario");
			}

			if(!$_POST){
				$usuario = UsuarioModel::getUser($id);
				if($usuario){
					$datos = array('destino' => 'usuario/editar/'. $id, 'usuario' => $usuario, 'submit' => 'Editar');
					View::render("usuario/formulario", $datos);
				}else{
					header("Location: " . URL . "usuario");
				}

			}else{
				echo "editando";
			}
		}

		public function crear(){

			HelperFunctions::comprobarSesion();

			if(Validaciones::validarId($id) !== true){
				header("Location: ". URL . "usuario");
			}

			if(!$_POST){
				$datos = array('destino' => 'usuario/crear', 'submit' => 'Crear');
				View::render("usuario/formulario", $datos);

			}else{
				echo "creando";
			}
		}
	}
?>