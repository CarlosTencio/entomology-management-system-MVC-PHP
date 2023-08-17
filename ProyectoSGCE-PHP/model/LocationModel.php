<?php

class LocationModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getCountries()
    {
        $consult = $this->db->prepare("CALL sp_obtener_paises()");
        $consult->execute();
        $countries = $consult->fetchAll();
        return $countries;
    } //getCountries

    public function getProvinces($country)
    {
        $consult = $this->db->prepare("CALL  sp_obtener_provincias(" .$country. ")");
        $consult->execute();
        $cantons = $consult->fetchAll();
        return $cantons;
    } //getProvinces

    public function getCantons($province)
    {
        $consult = $this->db->prepare("CALL sp_obtener_cantones(" . $province . ")");
        $consult->execute();
        $cantons = $consult->fetchAll();
        return $cantons;
    } //getCantons

    public function getDistricts($canton)
    {
        $consult = $this->db->prepare("CALL sp_obtener_distritos(" . $canton . ")");
        $consult->execute();
        $districts = $consult->fetchAll();
        return $districts;
    } //getDistricts
    
} //classLocationModel
?>