<?php

class SpecimenModel
{


    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct

    function registerSpecimen($gender, $species, $type, $storage, $drawer, $district, $date, $collector)
    {
        $consult = $this->db->prepare("CALL sp_registrar_especimen_etiqueta(" . $gender . "," . $species . "," . $type . ",'" . $storage . "',
            '" . $drawer . "'," . $district . ",'" . $date . "','" . $collector . "')");
        $consult->execute();
        $index = $consult->fetch();
        return $index['indice'];
    } //registerSpecimen

    function getSpecimens($species)
    {
        $consult = $this->db->prepare("CALL sp_obtener_especimenes(" . $species . ")");
        $consult->execute();
        $specimens = $consult->fetchAll();
        return $specimens;
    } //getSpecimens


    function getSpecimen($specimen)
    {
        $consult = $this->db->prepare("CALL sp_obtener_especimen(" . $specimen . ")");
        $consult->execute();
        $specimens = $consult->fetchAll();
        return $specimens;
    }

    function updateLocationSpecimen($specimen, $storage, $drawer)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_almacenamiento(" . $specimen . ",'" . $storage . "','" . $drawer . "')");
        $consult->execute();
        $consult->closeCursor();
    }//updateLocationSpecimen

    function registerImg($img, $specimen)
    {
        $consult = $this->db->prepare("CALL sp_registrar_img_especimen(?,?)");
        $consult->bindParam(1, $img);
        $consult->bindParam(2, $specimen);
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    }

    function updateTagSpecimen($tag, $district, $date, $collector)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_etiqueta(" . $tag . "," . $district . ",'" . $date . "','" . $collector . "')");
        $consult->execute();
        $consult->closeCursor();
    }

    function updateTaxSpecimen($specimen, $gender, $species)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_taxonomia(" . $specimen . "," . $gender . "," . $species . ")");
        $consult->execute();
        $consult->closeCursor();
    }

    function deleteImg($img)
    {
        $consult = $this->db->prepare("CALL sp_eliminar_img(" . $img . ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    }

    function deleteSpecimen($specimen){
        $consult = $this->db->prepare("CALL sp_eliminar_especimen_etiqueta(" . $specimen . ")");
        $consult->execute();
        $consult->closeCursor();
    }

    function getImages($specimen)
    {
        $consult = $this->db->prepare("CALL sp_obtener_img_especimen(?)");
        $consult->bindParam(1, $specimen);
        $consult->execute();
        $images = $consult->fetchAll();
        return $images;
    }


    function getSpecimenId()
    {
        $consult = $this->db->prepare("CALL sp_obtener_ultimo_index()");
        $consult->execute();
        $index = $consult->fetch();
        return $index['indice'];
    }

    function getLocations($username)
    {
        require 'CarModel.php';
        $car = new CarModel();
        $consult = $this->db->prepare("CALL sp_listar_ubicaciones_carrito(?)");
        $consult->bindParam(1, $username);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        $_SESSION['carGenders'] = $car->getIdsGendersCarSuperuser($_SESSION['username']);
        $_SESSION['carSpecies'] = $car->getIdsSpeciesCarSuperuser($_SESSION['username']);
        return $result;
    }
} //class




?>