<?php
class FrontController {
    
    public static function main() {
        require 'libs/View.php';
        require 'libs/configuration.php';
        
        if(!empty($_GET['controller']))
            $controllerName=$_GET['controller'].'Controller';
        else
            $controllerName='IndexController';
        
        if(!empty($_GET['action']))
            $nombreAccion=$_GET['action'];
        else
            $nombreAccion='showIndex';
        
        $rutaContralador=$config->get('controllerFolder').$controllerName.'.php';
        
        if(is_file($rutaContralador))
            require $rutaContralador;
        else 
            die ('Controlador no encontrado - 404 not found');
        
        if(!is_callable(array($controllerName,$nombreAccion))==FALSE){
            trigger_error($controllerName.'-'.$nombreAccion.' no existe', E_USER_NOTICE);
            return FALSE;
        }
        
        $controller=new $controllerName();
        $controller->$nombreAccion();
        
    } // main
    
} // fin clase

?>
