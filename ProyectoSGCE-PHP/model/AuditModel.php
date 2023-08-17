<?php

class AuditModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct

    public function registerAudit($description, $id)
    {
        $consult = $this->db->prepare("CALL sp_registrar_registro(?,?)");
        $consult->bindParam(1, $description);
        $consult->bindParam(2, $id);
        $consult->execute();

    }
    public function getAudit()
    {
        $consult = $this->db->prepare("CALL sp_obtener_registro");
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }

    public function getAuditYear($anio)
    {
        $consult = $this->db->prepare("CALL sp_buscar_registro_anio(?)");
        $consult->bindParam(1, $anio);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }
    public function getAuditDate($i_date,$f_date)
    {
        $consult = $this->db->prepare("CALL sp_registro_rango_fechas(?,?)");
        $consult->bindParam(1, $i_date);
        $consult->bindParam(2, $f_date);
        $consult->execute();
        $result = $consult->fetchAll();
        $consult->closeCursor();
        return $result;
    }
}
?>