<?php

class RecordModel
{

    private $db;
    public function __construct()
    {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::getInstance();
    } //construct

    public function registerRecord($specimen, $username)
    {
        $consult = $this->db->prepare("CALL sp_registrar_historial(?,?)");
        $consult->bindParam(1, $specimen);
        $consult->bindParam(2, $username);
        $consult->execute();
        $result = $consult->fetch(PDO::FETCH_ASSOC);
        $consult->closeCursor();
        return $result;
    }

}

?>