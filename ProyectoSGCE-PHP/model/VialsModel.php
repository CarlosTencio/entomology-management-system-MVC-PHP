<?php

class VialsModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getVials($box)
    {
        $consult = $this->db->prepare("CALL sp_obtener_viales(" . $box . ")");
        $consult->execute();
        $vials = $consult->fetchAll();
        return $vials;
    } //getBoxes

    public function registerVials($box,$num)
    {
        $consult = $this->db->prepare("CALL sp_registrar_viales(" . $box . "," . $num. ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    } //registerVial


} //calssBoxModel
?>