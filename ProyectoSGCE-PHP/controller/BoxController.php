<?php
session_start();
class BoxController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getBoxes()
    {
        require 'model/BoxModel.php';
        $boxModel = new BoxModel();
        $boxes['boxes'] = $boxModel->getBoxes();
        echo json_encode($boxes);
    } //getBoxes


    public function registerBox()
    {
        require_once 'model/BoxModel.php';
        require_once 'model/VialsModel.php';
        require_once 'model/AuditModel.php';
        $boxModel = new BoxModel();
        $auditModel = new AuditModel();
        $vialsModel = new VialsModel();
        $index = $boxModel->registerBox($_POST['box']);
        $vialsModel->registerVials($index, $_POST['vials']);
        $description = "Registró caja: " . $_POST['box'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        echo json_encode($index);
    }

    public function showRegisterBoxAdmin()
    {
        if (isset($_SESSION['username'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerBoxAdminView.php", null);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerBoxSuperuserView.php", null);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function registerBoxAdmins()
    {
        require_once 'model/BoxModel.php';
        require_once 'model/VialsModel.php';
        require_once 'model/AuditModel.php';
        $auditModel = new AuditModel();
        $vialsModel = new VialsModel();
        $boxModel = new BoxModel();
        $description = "Registró caja: " . $_POST['name-box'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $index = $boxModel->registerBox($_POST['name-box']);
        $vialsModel->registerVials($index, $_POST['number-vials']);
        $data = [
            'index' => $index,
            'box-registered' => $_POST['name-box'],
            'vials-registered' => $_POST['number-vials'],
        ];
        if ($_SESSION['role'] == 2) {
            $this->view->show("registerBoxAdminView.php", $data);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("registerBoxSuperuserView.php", $data);
        }
    }
}