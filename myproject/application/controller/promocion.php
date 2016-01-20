<?php
class Promocion
{

	public function index(){

        HelperFunctions::comprobarSesion();

		$promociones =  PromocionModel::getAllPromociones();
        $deshabilitados = PromocionModel::getAllDeshabilitados();

        $archivos = array("promocion/crearpromocion","promocion/listartodos",
            "promocion/listardeshabilitados");

        $datos = array('titulo' => 'Promociones','','promociones' => $promociones,
            'deshabilitados' => $deshabilitados);

        View::renderMulti($archivos, $datos);

	}

	public function mostrarPromocion($id){

        HelperFunctions::comprobarSesion();

        $promocion = PromocionModel::getPromocion($id);

        $datos = array('titulo' => 'Promocion', 'promocion' => $promocion);

        View::render("promocion/listaruno",$datos);
    }

     public function nuevaPromocion(){

        HelperFunctions::comprobarSesion();



        if(!$_POST){
            View::render('promocion/nuevaPromocion',
            array('titulo' => 'Nueva Promocion'
                ));

        }else{
        	$errores = [];

			if(!isset($_POST['descripcion']) || empty($_POST['descripcion'])){
				$errores['descripcion'] = ['descripcion' => 'El campo es requerido'];
			}

			if(($err = Validaciones::validarUnidades($_POST['unidades']))!== true){
				$errores['unidades'] = $err;
			}

			if(($err = Validaciones::validarDecimales($_POST['porcentaje']))!== true){
				$errores['porcentaje'] = $err;
			}

			if(($err = Validaciones::validarFecha($_POST['fecha_inicio']))!== true){
				$errores['fecha_inicio'] = $err;
			}

			if(($err = Validaciones::validarFecha($_POST['fecha_fin']))!== true){
				$errores['fecha_fin'] = $err;
			}

			if($errores){

        	 View::render('promocion/nuevaPromocion',
            array('titulo' => 'Nueva Promocion','errores' => $errores
                ));

        	}else{

        		$_POST['codigo'] = Validaciones::generarCodigo();

            PromocionModel::insertPromocion($_POST);

            View::render('promocion/promocionGuardada',
            array('titulo' => 'Promocion Guardada'
                ));
        	}

		}
    }


        public function borrarPromocion($id, $definitivo = false){

        HelperFunctions::comprobarSesion();

        if(Validaciones::validarId($id) !== true){
            header("Location: ". URL . "promocion");
        }

        if($definitivo === "true"){
            PromocionModel::borrarPromocion($id);
            header("Location: ". URL . "promocion");


        }else{
                $promocion = PromocionModel::getPromocion($id);

                if(!$promocion){
                    header("Location: ". URL . "promocion");
                }

                $archivos = array("promocion/listaruno", "promocion/borrarpromocion");
                $datos = array('titulo' => 'promocion', 'promocion' => $promocion);

                View::renderMulti($archivos, $datos);
            }
        }


         public function habilitarPromocion($id, $definitivo = false){

        HelperFunctions::comprobarSesion();

        if(Validaciones::validarId($id) !== true){
            header("Location: ". URL . "promocion");
        }

        if($definitivo === "true"){
            PromocionModel::habilitarPromocion($id);
            header("Location: ". URL . "promocion");


        }else{
                $promocion = PromocionModel::getPromocion($id);

                if(!$promocion){
                    header("Location: ". URL . "promocion");
                }

                $archivos = array("promocion/listaruno", "promocion/habilitarpromocion");
                $datos = array('titulo' => 'promocion', 'promocion' => $promocion);

                View::renderMulti($archivos, $datos);
            }
        }

         public function editarPromocion($id){

        HelperFunctions::comprobarSesion();



        if(!$_POST){

            $promocion = PromocionModel::getPromocion($id);


            View::render('promocion/editarPromocion',
            array('titulo'   => 'Promocion',
                  'promocion' => $promocion,
                  'destino' => 'promocion/editarPromocion/' . $id
                ));

        }else{

        	$errores = [];

			if(!isset($_POST['descripcion']) || empty($_POST['descripcion'])){
				$errores['descripcion'] = ['descripcion' => 'El campo es requerido'];
			}

			if(($err = Validaciones::validarUnidades($_POST['unidades']))!== true){
				$errores['unidades'] = $err;
			}

			if(($err = Validaciones::validarDecimales($_POST['porcentaje']))!== true){
				$errores['porcentaje'] = $err;
			}

			if(($err = Validaciones::validarFecha($_POST['fecha_inicio']))!== true){
				$errores['fecha_inicio'] = $err;
			}

			

			if($errores){
				 var_dump($errores);

        	 View::render('promocion/editarPromocion',
            array('titulo' => 'Nueva Promocion','errores' => $errores
                ));

        	}else{

            PromocionModel::editPromocion($id,$_POST);

            View::render('promocion/promocionEditada',
            array('titulo' => 'Promocion Guardada'
                ));
        }

    }

}

}