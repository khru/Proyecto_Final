<?php
class Articulo
{
	public function index(){
        HelperFunctions::comprobarSesion();
		$articulos = ArticuloModel::getAllArticulos();
        $deshabilitados = ArticuloModel::getAllArticulos(0);
        $archivos = ['articulo/todos', 'articulo/deshabilitados'];
		View::renderMulti($archivos,
			array('titulo'    => 'Lista de Artículos',
				  'articulos' => $articulos,
                  'deshabilitados' => $deshabilitados
				  ));
	}

    public function mostrarArticulo($url){
        $articulo = ArticuloModel::getArticulo($url);

        View::clientRender('articulo/mostrarArticulo',
            array('titulo'   => 'Articulo',
            	  'articulo' => $articulo
            	));
    }

    public function nuevoArticulo(){
        HelperFunctions::comprobarSesion();
    	if(!$_POST){
    		View::render('articulo/nuevoArticulo',
    		array('titulo' => 'Nuevo Articulo'
    			));

    	}else{
            $_POST = HelperFunctions::sanear($_POST);

            $errores = [];

            if(!isset($_POST['titulo']) || empty($_POST['titulo'])){
                $errores['titulo'] = ['titulo' => 'Debes introducir un título'];
            }

            if(!isset($_POST['cuerpo']) || empty($_POST['cuerpo'])){
                $errores['cuerpo'] = ['cuerpo' => 'Debes introducir un cuerpo'];
            }

            if($errores){
                View::render('articulo/nuevoArticulo',
                    array('titulo' => 'Nuevo Articulo',
                        'errores' => $errores
                    ));
            }else{
                if(isset($_POST['publicar']) && $_POST['publicar'] = 'on'){
                    $_POST['publicar'] = 1;
                }else{
                    $_POST['publicar'] = 0;
                }

                $datos = $_POST;
                $titulo = $_POST['titulo'];
                $url = HelperFunctions::generarUrl($titulo);

                ArticuloModel::nuevoArticulo($datos);

                View::render('articulo/articuloGuardado',
                array('titulo' => 'Articulo Guardado',
                     'url'    => $url
                    ));
            }
    	}
    }

    public function borrar($url, $definitivo = false){
        HelperFunctions::comprobarSesion();

        if($definitivo === "true"){
            ArticuloModel::borrar($url);
            header("Location: ". URL . "articulo");


        }else{
            $articulo = ArticuloModel::getArticulo($url);

            if(!$articulo){
                header("Location: ". URL . "articulo");
            }

            $archivos = array("articulo/mostrarArticulo", "articulo/borrarArticulo");
            $datos = array('titulo' => 'Borrar Articulo', 'articulo' => $articulo);

            View::renderMulti($archivos, $datos);
        }
    }


    public function habilitar($url, $definitivo = false){
        HelperFunctions::comprobarSesion();

        if($definitivo === "true"){
            ArticuloModel::habilitar($url);
            header("Location: ". URL . "articulo");


        }else{
            $articulo = ArticuloModel::getArticulo($url);

            if(!$articulo){
                header("Location: ". URL . "articulo");
            }

            $archivos = array("articulo/mostrarArticulo", "articulo/habilitarArticulo");
            $datos = array('titulo' => 'Habilitar Articulo', 'articulo' => $articulo);

            View::renderMulti($archivos, $datos);
        }
    }

}