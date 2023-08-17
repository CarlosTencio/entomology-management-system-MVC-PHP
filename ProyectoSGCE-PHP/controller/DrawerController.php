<?php
session_start();
class DrawerController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getDrawers()
    {
        require 'model/DrawerModel.php';
        $drawerModel = new DrawerModel();
        $drawers['drawers'] = $drawerModel->getDrawers($_POST['cabinet']);
        echo json_encode($drawers);
    } //getDrawers

    public function showRegisterDrawerAdmin(){
        require 'model/CabinetModel.php';
        $cabinetModel = new CabinetModel();
        $cabinets['cabinets'] = $cabinetModel->getCabinets();
        if ($_SESSION['role'] == 2) {
            $this->view->show("registerDrawerAdminView.php",  $cabinets);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("registerDrawerSuperuserView.php",  $cabinets);
        }else{
            $this->view->show("indexView.php", null);
        }
    }

    public function registerDrawersAdmins(){
        require_once 'model/DrawerModel.php';
        require_once 'model/AuditModel.php';
        require 'model/CabinetModel.php';
        $cabinetModel = new CabinetModel();
        $cabinets = $cabinetModel->getCabinets();
        $auditModel = new AuditModel();
        $drawerModel = new DrawerModel();
        // $description = "Registró gaveta: " . $_POST['drawer'];
        // $auditModel->registerAudit($description, $_SESSION['username']);
        $parts = explode(" ", $_POST['number-cabinet']);
        $response = $drawerModel->registerDrawers($parts[0], $_POST['number-drawers']);
        $data = [
            'cabinets' => $cabinets,
            'drawers-registered' => $_POST['number-drawers'],
            'cabinet-registered' => $_POST['number-cabinet']
        ];
        if ($_SESSION['role'] == 2) {
            $this->view->show("registerDrawerAdminView.php",   $data );
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("registerDrawerSuperuserView.php",   $data );
        }
    }

}

?>