<?php
session_start();
class CabinetController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getCabinets()
    {
        require 'model/CabinetModel.php';
        $cabinetModel = new CabinetModel();
        $cabinets['cabinets'] = $cabinetModel->getCabinets();
        echo json_encode($cabinets);
    } //getCabinets

    public function showRegisterCabinetAdmin()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerCabinetAdminView.php", null);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerCabinetSuperuserView.php", null);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function registerCabinetAdmins()
    {
        require_once 'model/CabinetModel.php';
        require_once 'model/AuditModel.php';
        require_once 'model/DrawerModel.php';
        $auditModel = new AuditModel();
        $cabinetModel = new CabinetModel();
        $drawerModel = new DrawerModel();

        $index = $cabinetModel->registerCabinet($_POST['name-cabinet']);
        $response = $drawerModel->registerDrawers($index, $_POST['number-drawers']);
        $description = "Registró gabinete: " . $_POST['name-cabinet'];
        $auditModel->registerAudit($description, $_SESSION['username']);

        $data = [
            'cabinet-registered' => $_POST['name-cabinet'],
            'drawers-registered' => $_POST['number-drawers'],
            'index' => $index
        ];

        if ($_SESSION['role'] == 2) {
            $this->view->show("registerCabinetAdminView.php", $data);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("registerCabinetSuperuserView.php", $data);
        }
    }

    public function registerCabinet()
    {
        require_once 'model/CabinetModel.php';
        require_once 'model/AuditModel.php';
        require_once 'model/DrawerModel.php';

        $auditModel = new AuditModel();
        $cabinetModel = new CabinetModel();
        $drawerModel = new DrawerModel();

        $index = $cabinetModel->registerCabinet($_POST['cabinet']);
        $response = $drawerModel->registerDrawers($index, $_POST['drawers']);
        $description = "Registró gabinete: " . $_POST['cabinet'];
        $auditModel->registerAudit($description, $_SESSION['username']);
    }

}