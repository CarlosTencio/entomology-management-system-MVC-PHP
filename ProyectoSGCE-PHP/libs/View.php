<?php

/**
 * Description of View
 *
 * @author XPC
 */
class View {
    public function __construct() {
        ;
    } // constructor
    
    public function show($nombreVista, $vars=array()) {
        $config= Config::getInstance();
        $path=$config->get('viewFolder').$nombreVista;
        
        if(is_file($path)==FALSE){
            trigger_error('Página '.$path.' No existe',E_USER_NOTICE);
            return false;
        }
        
        if(is_array($vars)){
            foreach($vars as $key=>$value){
                $key=$value;
            }
        }
        
        include $path;
        
    } // show
    
} // fin clase

?>