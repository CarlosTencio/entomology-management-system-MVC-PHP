<?php


class FamilyModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getFamilies($order)
    {
        $consult = $this->db->prepare("CALL sp_obtener_familias(" . $order . ")");
        $consult->execute();
        $families = $consult->fetchAll();
        return $families;

    } //getFamilies

    public function getAllFamilies()
    {
        $consult = $this->db->prepare("CALL sp_listar_familias()");
        $consult->execute();
        $families = $consult->fetchAll();
        return $families;

    } //getFamilies

    public function registerFamily($family, $order)
    {

        $consult = $this->db->prepare("CALL sp_registrar_familia('" . $family . "'," . $order . ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    } //registerFamily

    public function updateFamily($id_family, $name, $order)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_familia(" . $id_family . ",'" . $name . "'," . $order . ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    } //updateFamily


    public function searchFamily($family)
    {
        $consult = $this->db->prepare("CALL sp_buscar_familia('" . $family . "')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    }

    public function showAllFamiliesAsc($nombre)
    {
        $consult = $this->db->prepare("CALL sp_listar_familia_asc(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;

    }
    public function showAllFamiliesDesc($nombre)
    {
        $consult = $this->db->prepare("CALL sp_listar_familia_desc(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }

    public function showGenderFamily($nombre)
    {
        $consult = $this->db->prepare("CALL sp_generos_de_familia(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }
} //class FamilyModel