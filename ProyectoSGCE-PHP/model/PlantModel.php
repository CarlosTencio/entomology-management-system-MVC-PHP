<?php


class PlantModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function listGenderSpecies($nombre)
    {
        $consult = $this->db->prepare("CALL sp_buscar_planta('" . $nombre . "')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    }

    public function getPlants()
    {
        $consult = $this->db->prepare("CALL sp_listar_plantas()");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    } //getPlants

    public function searchPlants($plant)
    {
        $consult = $this->db->prepare("CALL sp_buscar_plantas_por_nombre('" . $plant . "')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    }

    public function updatePlant($id, $name)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_planta(" . $id . ",'" . $name . "')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    }

    public function listPlant($gender)
    {
        $consult = $this->db->prepare("CALL  sp_obtener_plantas(" . $gender . ")");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    } //getPlant

    public function getQuantityPlants()
    {
        $consult = $this->db->prepare("CALL sp_cantidad_plantas()");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return count($resultado);
    }

    public function registerPlant($plant)
    {
        $consult = $this->db->prepare("CALL sp_registrar_planta('" . $plant . "')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    } //registerPlant

    public function deletePlantsGender($id)
    {
        $consult = $this->db->prepare("CALL sp_eliminar_plantas(" . $id . ")");
        $consult->execute();
        $consult->closeCursor();
    } //deletePlantGender
} //class GenderModel