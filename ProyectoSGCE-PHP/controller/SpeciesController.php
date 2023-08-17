<?php
session_start();
class SpeciesController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getSpecies()
    {
        require 'model/SpeciesModel.php';
        $speciesModel = new SpeciesModel();
        $species['species'] = $speciesModel->getSpecies($_POST['gender']);
        echo json_encode($species);
    } //getSpecies

    public function getAllSpecies()
    {
        require 'model/SpeciesModel.php';
        $speciesModel = new SpeciesModel();
        $species['species'] = $speciesModel->getAllSpecies();
        echo json_encode($species);
    } //getSpecies

    public function showSpecies()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SpeciesModel.php';
            $speciesModel = new SpeciesModel();
            $species = $speciesModel->getSpecies($_POST['gender']);
            if (isset($_POST['namegender'])) {
                $specie = $_POST['namegender'];
            } else {
                $specie = null;
            }
            $data = [
                'species' => $species,
                'name' => $specie
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpeciesAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpeciesSuperuserView.php", $data);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("showSpeciesUserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSpeciesForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SpeciesModel.php';
            $speciesModel = new SpeciesModel();
            $species = $speciesModel->getSpecies($_POST['gender']);
            if (isset($_POST['namegender'])) {
                $specie = $_POST['namegender'];
            } else {
                $specie = null;
            }
            $data = [
                'species' => $species,
                'name' => $specie
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpeciesForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpeciesForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showRegisterSpeciesAdmin()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $orders['orders'] = $orderModel->getOrders();
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerSpeciesAdminView.php", $orders);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerSpeciesSuperuserView.php", $orders);
            }
        } else {
            $this->view->show("indexView.php", null);
        }

    } //showRegisterSpeciesAdmin

    public function registerSpecies()
    {
        require_once 'model/SpeciesModel.php';
        require_once 'model/AuditModel.php';
        $speciesModel = new SpeciesModel();
        $auditModel = new AuditModel();
        $description = "Registró especie: " . $_POST['species'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $response = $speciesModel->registerSpecies($_POST['species'], $_POST['gender']);
        echo json_encode($response);
    }

    public function registerSpeciesAdmin()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpeciesModel.php';
            require_once 'model/OrderModel.php';
            require_once 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $speciesModel = new SpeciesModel();
            $orderModel = new OrderModel();
            $description = "Registró especie: " . $_POST['name-species'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $orders = $orderModel->getOrders();

            $response = $speciesModel->registerSpecies($_POST['name-species'], $_POST['select-gender']);
            $data = [
                'orders' => $orders,
                'order-registered' => $_POST['name-order'],
                'family-registered' => $_POST['name-family'],
                'subfamily-registered' => $_POST['name-family'],
                'gender-registered' => $_POST['name-gender'],
                'species-registered' => $_POST['name-species']
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerSpeciesAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerSpeciesSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updateSpecies()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpeciesModel.php';
            require_once 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $speciesModel = new SpeciesModel();
            $description = "Actualizó especie: " . $_POST['id-species'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $response = $speciesModel->updateSpecies($_POST['id-species'], $_POST['select-gender'], $_POST['submit-species']);
            $data = [
                'order-updated' => $_POST['submit-order'],
                'family-updated' => $_POST['submit-family'],
                'subfamily-updated' => $_POST['submit-subfamily'],
                'gender-updated' => $_POST['submit-gender'],
                'species-updated' => $_POST['submit-species']
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchGenderSpeciesForUpdateEmptyAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchGenderSpeciesForUpdateEmptySuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function getSpeciesByName($gender)
    {
        $consult = $this->db->prepare("CALL sp_obtener_especies_porgenero(?)");
        $consult->bindParam(1, $gender);
        $consult->execute();
        $species = $consult->fetchAll();
        return $species;
    }

}

?>