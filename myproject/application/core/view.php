<?php
class View
{
    public static function render($filename, $data = null){
        
        require APP . 'view/_templates/header.php';
        require APP . 'view/'. $filename .'.php';
        require APP . 'view/_templates/footer.php';
    }//render()

    //Renderiza una vista a partir de múltiples ficheros
    //Los ficheros se incluirán en el orden de aparición de la página
    //$filenames es un array con los archivos de las vistas
    //Si no se le pasa un array, se ejecuta el render habitual
    public static function renderMulti($filenames, $data = null){
        
        if(is_array($filenames)){
        	require APP . 'view/_templates/header.php';

        	foreach ($filenames as $filename) {
        		require APP . 'view/'. $filename .'.php';
        	}

        	require APP . 'view/_templates/footer.php';

        }else{
        	self::render($filenames, $data);
        }       
    }//renderMulti()
}