<?php
class Articulo
{
	public function index(){
        HelperFunctions::comprobarSesion();
		$articulos = ArticuloModel::getAllArticulos();

		View::render('articulo/todos',
			array('titulo'    => 'Lista de Artículos',
				  'articulos' => $articulos
				  ));
	}

    public function mostrarArticulo($url){
        HelperFunctions::comprobarSesion();
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

}