<?php
    require 'libs/Config.php';
    $config=Config::getInstance();
    
    $config->set('controllerFolder', 'controller/');
    $config->set('modelFolder', 'model/');
    $config->set('viewFolder', 'view/');

    //configuracion de la base de datos
    $config->set('dbhost','localhost');
    $config->set('dbname','db_entomologia');
    $config->set('dbuser','root');
    $config->set('dbpass','');
?>


