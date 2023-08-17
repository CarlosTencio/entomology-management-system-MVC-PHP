<?php


class SubfamilyModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getSubfamilies($family)
    {
        $consult = $this->db->prepare("CALL sp_obtener_subfamilias(" . $family . ")");
        $consult->execute();
        $subfamilies = $consult->fetchAll();
        return $subfamilies;
    } //getSubfamilies

    public function getAllSubfamilies()
    {
        $consult = $this->db->prepare("CALL sp_listar_subfamilias()");
        $consult->execute();
        $subfamilies = $consult->fetchAll();
        return $subfamilies;
    } //getSubfamilies

    public function registerSubfamily($subfamily, $family)
    {
        $consult = $this->db->prepare("CALL sp_registrar_subfamilia('" . $subfamily . "'," . $family . ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    } //registerSubfamily

    public function updateSubfamily($id_subfamily, $name, $family)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_subfamilia(" . $id_subfamily . ",'" . $name . "'," . $family . ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    } //updateSubfamily

    public function searchSubfamily($subfamily)
    {
        $consult = $this->db->prepare("CALL sp_buscar_subfamilia('" . $subfamily . "')");
        $consult->execute();
        $subfamilies = $consult->fetchAll();
        return $subfamilies;
    } //searchSubfamily

    public function showAllSubfamiliesAsc($nombre)
    {
        $consult = $this->db->prepare("CALL sp_obtener_subfamilias_asc(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;

    }
    public function showAllSubfamiliesDesc($nombre)
    {
        $consult = $this->db->prepare("CALL sp_obtener_subfamilias_desc(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;

    }

    public function showGenderSubfamily($nombre)
    {
        $consult = $this->db->prepare("CALL sp_generos_de_subfamilia(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }
} //class SubfamilyModel