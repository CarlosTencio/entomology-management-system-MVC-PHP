<?php


class GenderModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct


    public function getGendersFamily($family)
    {
        $consult = $this->db->prepare("CALL sp_obtener_generos_familia(" . $family . ")");
        $consult->execute();
        $genders = $consult->fetchAll();
        $consult->closeCursor();
        return $genders;

    } //getGenders

    public function getGendersSubfamily($subfamily)
    {
        $consult = $this->db->prepare("CALL sp_obtener_generos_subfamilia(" . $subfamily . ")");
        $consult->execute();
        $genders = $consult->fetchAll();
        $consult->closeCursor();
        return $genders;
    } //getGenders

    public function registerGender($gender, $family, $subfamily)
    {
        $consult = $this->db->prepare("CALL sp_registrar_genero('" . $gender . "'," . $subfamily . "," . $family . ")");
        $consult->execute();
        $index = $consult->fetch();
        return $index['indice'];
    }

    public function updateGender($id, $family, $subfamily, $gender)
    {
        $consult = $this->db->prepare("CALL sp_actualizar_genero(" . $id . "," . $family . "," . $subfamily . ",'" . $gender . "')");
        $consult->execute();
        $consult->closeCursor();
    } //updateGender

    public function listGenderSpecies($nombre)
    {
        $consult = $this->db->prepare("CALL sp_buscar_genero_especie('" . $nombre . "')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    }

    function getLastIndex()
    {
        $consult = $this->db->prepare("CALL sp_obtener_ultimo_index()");
        $consult->execute();
        $index = $consult->fetch();
        $echo = $index['indice'];
        return $index['indice'];
    }

    function registerGenderPlant($gender, $plant)
    {
        $consult = $this->db->prepare("CALL sp_relacionar_planta_genero(" . $plant . "," . $gender . ")");
        $consult->execute();
        $consult->closeCursor();
        $rowCount = $consult->rowCount(); // Obtener el número de filas afectadas por la consulta

        if ($rowCount > 0) {
            return true; // Registro exitoso
        } else {
            return false; // Error en el registro
        }
    }

    function getGender($id)
    {
        $consult = $this->db->prepare("CALL sp_buscar_genero_por_id(" . $id . ")");
        $consult->execute();
        $gender = $consult->fetch();
        $consult->closeCursor();
        return $gender['nombre'];
    }

    function getAllGenders()
    {
        $consult = $this->db->prepare("CALL sp_listar_generos()");
        $consult->execute();
        $genders = $consult->fetchAll();
        $consult->closeCursor();
        return $genders;
    }


} //class GenderModel