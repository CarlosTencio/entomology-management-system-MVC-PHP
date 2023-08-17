<?php


class SpeciesModel
{
    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getSpecies($gender)
    {
        $consult = $this->db->prepare("CALL sp_obtener_especies(" . $gender . ")");
        $consult->execute();
        $species = $consult->fetchAll();
        return $species;
    } //getGenders

    public function getAllSpecies()
    {
        $consult = $this->db->prepare("CALL sp_listar_especies()");
        $consult->execute();
        $species = $consult->fetchAll();
        return $species;
    } //getAllGenders

    public function searchSpecies($name)
    {
        echo $name;
        $consult = $this->db->prepare("CALL sp_buscar_especie('" . $name . "')");
        $consult->execute();
        $species = $consult->fetchAll();
        echo json_encode($species);
        return $species['id_especie'];
    } //searchSpecies


    public function registerSpecies($species, $gender)
    {
        $consult = $this->db->prepare("CALL sp_registrar_especie('" . $species . "'," . $gender . ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            $result = $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    }

    public function getSpeciesByName($gender)
    {
        $consult = $this->db->prepare("CALL sp_obtener_especies_porgenero(?)");
        $consult->bindParam(1, $gender);
        $consult->execute();
        $species = $consult->fetchAll();
        return $species;
    }

    function updateSpecies($id, $gender, $name)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_especie(" . $id . "," . $gender . ",'" . $name . "')");
        $consult->execute();
        $consult->closeCursor();
    } //updateSpecies

} //class GenderModel