<?php
session_start();


class RecordController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor


public function registerInRecord(){
    require 'model/RecordModel.php';
    require_once 'model/AuditModel.php';
    $recordModel = new RecordModel();
    $response = $recordModel->registerRecord($_POST['record'], $_POST['subfamily']);
    echo json_encode($response);
}

}


?>