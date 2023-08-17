<?php


class CabinetModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getCabinets()
    {
        $consult = $this->db->prepare("CALL sp_obtener_gabinetes()");
        $consult->execute();
        $cabinets = $consult->fetchAll();
        return $cabinets;
    } //getCabinets

    public function registerCabinet($cabinet)
    {
        $consult = $this->db->prepare("CALL sp_registrar_gabinete('" . $cabinet . "')");
        $consult->execute();
        $index = $consult->fetch();
        return $index['indice'];
    } //registerCabinet


} //classCabinetModel
?>