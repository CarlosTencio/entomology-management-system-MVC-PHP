<?php

class CarModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct

    public function addToCarSuper($id, $type, $username)
    {
        $consult = $this->db->prepare("CALL sp_anadir_al_carrito_superusuario(" . $type . "," . $id . ", '" . $username . "')");
        $consult->execute();
        $rowCount = $consult->rowCount();
        $_SESSION['carGenders'] = $this->getIdsGendersCarSuperuser($_SESSION['username']);
        $_SESSION['carSpecies'] = $this->getIdsSpeciesCarSuperuser($_SESSION['username']);
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    } //addToCar

    public function getCarSuperuser($specimen, $username)
    {
        $consult = $this->db->prepare("CALL sp_mostrar_carrito_superusuario(" . $specimen . ", '" . $username . "')");
        $consult->execute();
        $result = $consult->fetch();
        return $result;
    } //getCar

    public function seeCarSuperuser($username)
    {
        $consult = $this->db->prepare("CALL  sp_ver_carrito_superusuario('" . $username . "')");
        $consult->execute();
        $result = $consult->fetchAll();
        return $result;
    }

    public function getIdsGendersCarSuperuser($username)
    {
        $consult = $this->db->prepare("CALL  sp_ids_generos_carrito_superusuario('" . $username . "')");
        $consult->execute();
        $array = $consult->fetchAll();
        $result = array_column($array, 'genero');
        return $result;
    }

    public function getIdsSpeciesCarSuperuser($username)
    {
        $consult = $this->db->prepare("CALL  sp_ids_especies_carrito_superusuario('" . $username . "')");
        $consult->execute();
        $array = $consult->fetchAll();
        $result = array_column($array, 'especie');
        return $result;
    }

    public function getIdsGendersViewsSuperuser($username)
    {
        $consult = $this->db->prepare("CALL  sp_ids_generos_vistos_superusuario('" . $username . "')");
        $consult->execute();
        $array = $consult->fetchAll();
        $result = array_column($array, 'genero');
        return $result;
    }

    public function getIdsSpeciesViewsSuperuser($username)
    {
        $consult = $this->db->prepare("CALL  sp_ids_especies_vistos_superusuario('" . $username . "')");
        $consult->execute();
        $array = $consult->fetchAll();
        $result = array_column($array, 'especie');
        return $result;
    }

    public function deleteFromCarSuperuser($username, $id,$type)
    {
        $consult = $this->db->prepare("CALL sp_eliminar_del_carrito_superusuario(" . $id . ", '" . $username . "',". $type .")");
        $consult->execute();
        $rowCount = $consult->rowCount();
            $_SESSION['carGenders'] = $this->getIdsGendersCarSuperuser($_SESSION['username']);
        $_SESSION['carSpecies'] = $this->getIdsSpeciesCarSuperuser($_SESSION['username']);
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    } //deleteFromCar


    public function addToSeeSuperuser($username,$id,$type)
    {
        $consult = $this->db->prepare("CALL sp_anadir_a_visto_superusuario( '" . $username . "'," . $id . ",".$type. ")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        $_SESSION['viewsGenders'] = $this->getIdsGendersViewsSuperuser($_SESSION['username']);
        $_SESSION['viewsSpecies'] = $this->getIdsSpeciesViewsSuperuser($_SESSION['username']);
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    }

    public function getSeeSuperuser($specimen, $username)
    {
        $consult = $this->db->prepare("CALL sp_mostrar_visto_superusuario( '" . $username . "'," . $specimen . ")");
        $consult->execute();
        $result = $consult->fetch();
        return $result;
    } //getSee

    public function getViewsSuperuser($username)
    {
        $consult = $this->db->prepare("CALL  sp_ver_vistos_superusuario('" . $username . "')");
        $consult->execute();
        $result = $consult->fetchAll();
        return $result;
    }

    public function getIdsViewsSuperuser($username)
    {
        $consult = $this->db->prepare("CALL  sp_ids_vistos_superusuario('" . $username . "')");
        $consult->execute();
        $array = $consult->fetchAll();
        if ($array == null) {
            return $array;
        } else {
            $result = array_column($array, 'id_especimen');
            return $result;
        }
    }

    public function deleteFromViewsSuperuser($username, $id,$type)
    {
        $consult = $this->db->prepare("CALL sp_eliminar_de_vistos_superusuario( '" . $username . "'," . $id . ",".$type.")");
        $consult->execute();
        $rowCount = $consult->rowCount();
        $_SESSION['viewsGenders'] = $this->getIdsGendersViewsSuperuser($_SESSION['username']);
        $_SESSION['viewsSpecies'] = $this->getIdsSpeciesViewsSuperuser($_SESSION['username']);
        if ($rowCount > 0) {
            return $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    }

    //nuevo--------------------------------------------------------------------------------------------------------


}
?>