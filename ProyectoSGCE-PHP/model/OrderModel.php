<?php


class OrderModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct

    public function searchOrders($query)
    {
        $consult = $this->db->prepare("CALL sp_buscar_ordenes(?)");
        $consult->bindParam(1, $query);
        $consult->execute();
        $orders = $consult->fetchAll(PDO::FETCH_ASSOC);
        if ($orders) {
            return $orders;
        } else {
            return false;
        }
    } //searchOrders

    public function getOrders()
    {
        $consult = $this->db->prepare("CALL sp_obtener_ordenes()");
        $consult->execute();
        $orders = $consult->fetchAll();
        if($orders){
            return $orders;
        }else{
            return null;
        }
    } //getOrders

public function searchOrder($order){
        $consult = $this->db->prepare("CALL sp_buscar_orden('".$order."')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
}

    public function registerOrder($name)
    {
        $consult = $this->db->prepare("CALL sp_registrar_orden('" . $name . "')");
        $consult->execute();

        $rowCount = $consult->rowCount();
        if ($rowCount > 0) {
            $result = $consult->fetch(PDO::FETCH_ASSOC);
        } else {
            return null; // Error en el registro
        }
    }
    public function showAllOrdersAsc($nombre)
    {
        $consult = $this->db->prepare("CALL sp_obtener_ordenes_asc(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }
    public function showAllOrdersDesc($nombre)
    {
        $consult = $this->db->prepare("CALL sp_obtener_ordenes_desc(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }

    public function showGenderOrder($nombre)
    {
        $consult = $this->db->prepare("CALL sp_generos_de_orden(?)");
        $consult->bindParam(1, $nombre);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }
 
    public function updateOrder($order,$name){
        $consult = $this->db->prepare("CALL sp_actualizar_orden(".$order.",'".$name."')");
        $consult->execute();
        $resultado = $consult->fetchAll();
        return $resultado;
    }
} //class OrderController