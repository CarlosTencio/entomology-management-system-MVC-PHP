<?php

class BoxModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getBoxes()
    {
        $consult = $this->db->prepare("CALL sp_obtener_cajas()");
        $consult->execute();
        $boxes = $consult->fetchAll(); 
        return $boxes;
    } //getBoxes

    public function registerBox($box)
    {
        $consult = $this->db->prepare("CALL sp_registrar_caja('" . $box . "')");
        $consult->execute();
        $resultado = $consult->fetch();
        return $resultado['indice'];
    } //registerBox


} //calssBoxModel
?>