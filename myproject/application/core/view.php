<?php
class View
{
    public static function render($filename, $data = null){
        
        require APP . 'view/_templates/header.php';
        require APP . 'view/'. $filename .'.php';
        require APP . 'view/_templates/footer.php';
    }
}