<?php
session_start();
class VialsController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getVials()
    {
        require 'model/VialsModel.php';
        $vialModel = new VialsModel();
        $vials['vials'] = $vialModel->getVials($_POST['box']);
        echo json_encode($vials);
    } //getVials

    public function showRegisterVialsAdmin()
    {
        require_once 'model/BoxModel.php';
        $boxModel = new BoxModel();
        $boxes['boxes'] = $boxModel->getBoxes();
        if ($_SESSION['role'] == 2) {
            $this->view->show("registerVialsAdminView.php", $boxes);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("registerVialsSuperuserView.php", $boxes);
        }
    }

    public function registerVialsAdmins()
    {
        require_once 'model/VialsModel.php';
        require_once 'model/AuditModel.php';
        require_once 'model/BoxModel.php';
        $boxModel = new BoxModel();
        $auditModel = new AuditModel();
        $vialModel = new VialsModel();
        $boxes['boxes'] = $boxModel->getBoxes();
        // $description = "Registró caja: " . $_POST['box'];
        // $auditModel->registerAudit($description, $_SESSION['username']);
        $vialModel->registerVials($_POST['select-box'], $_POST['number-vials']);
        $data = [
            'box-registered' => $_POST['select-box'],
            'vials-registered' => $_POST['number-vials']
        ];
        if ($_SESSION['role'] == 2) {
            $this->view->show("registerVialsAdminView.php", $data);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("registerVialsSuperuserView.php", $data);
        }
    }

    public function registerVials()
    {
        require 'model/VialsModel.php';
        $vialModel = new VialsModel();
        $response = $vialModel->registerVials($_POST['box']);
        echo json_encode($response);
    }
}

?>