<?php

class DrawerModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getDrawers($cabinet)
    {
        $consult = $this->db->prepare("CALL sp_obtener_gavetas(" . $cabinet . ")");
        $consult->execute();
        $drawers = $consult->fetchAll();
        return $drawers;
    } //getDrawers

    public function registerDrawers($cabinet,$quantity){
        $consult = $this->db->prepare("CALL sp_registrar_gavetas(" . $cabinet . "," . $quantity . ")");
        $consult->execute();
       $rowCount = $consult->rowCount();
        if($rowCount > 0){
            return true;
        }else{
            return false;
        }
    }

} //classCabinetModel


?>