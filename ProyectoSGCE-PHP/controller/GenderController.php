<?php
session_start();
class GenderController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getGenders()
    {
        require 'model/GenderModel.php';
        $genderModel = new GenderModel();
        if ($_POST['option'] == 1) {
            $genders['genders'] = $genderModel->getGendersFamily($_POST['family']);
            echo json_encode($genders);
        } else {
            $genders['genders'] = $genderModel->getGendersSubfamily($_POST['subfamily']);
            echo json_encode($genders);
        }
    } //getGenders

    public function getAllGenders()
    {
        require 'model/GenderModel.php';
        $genderModel = new GenderModel();
        $genders['genders'] = $genderModel->getAllGenders();
        echo json_encode($genders);

    } //getAllGenders

    public function showRegisterGenderAdmin()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/OrderModel.php';
            require_once 'model/PlantModel.php';
            $orderModel = new OrderModel();
            $plantsModel = new PlantModel();
            $orders = $orderModel->getOrders();
            $plants = $plantsModel->getPlants();
            $plantsQuantity = $plantsModel->getQuantityPlants();
            $data = [
                'orders' => $orders,
                'plants' => $plants,
                'plantsQuantity' => $plantsQuantity / 8
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerGenderAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerGenderSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function registerGender()
    {
        require 'model/GenderModel.php';
        require_once 'model/AuditModel.php';
        $genderModel = new GenderModel();
        $auditModel = new AuditModel();
        $description = "Registró familia: " . $_POST['name-family'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $response = $genderModel->registerGender($_POST['gender'], $_POST['family'], $_POST['subfamily']);
        echo json_encode($response);
    }

    public function registerGenderAdmins()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/OrderModel.php';
            require_once 'model/PlantModel.php';
            require_once 'model/GenderModel.php';
            require_once 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $orderModel = new OrderModel();
            $plantsModel = new PlantModel();
            $genderModel = new GenderModel();
            $description = "Registró familia: " . $_POST['name-family'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $orders = $orderModel->getOrders();
            $plants = $plantsModel->getPlants();
            $plantsQuantity = $plantsModel->getQuantityPlants();
            $index = $genderModel->registerGender($_POST['name-gender'], $_POST['select-family'], $_POST['select-subfamily']);

            if (isset($_POST['checkbox-plants'])) {
                foreach ($_POST['checkbox-plants'] as $plant) {
                    $genderModel->registerGenderPlant($index, $plant);
                }
                $_POST['checkbox-plants'] = array();
            }

            $data = [
                'orders' => $orders,
                'plants' => $plants,
                'plantsQuantity' => $plantsQuantity / 8,
                'order-registered' => $_POST['name-order'],
                'family-registered' => $_POST['name-family'],
                'subfamily-registered' => $_POST['name-family'],
                'gender-registered' => $_POST['name-gender']
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerGenderAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerGenderSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updateGender()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/GenderModel.php';
            require_once 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $genderModel = new GenderModel();
            $description = "Actualizó género: " . $_POST['id-gender'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $genderModel->updateGender($_POST['id-gender'], $_POST['select-family-gender'], $_POST['select-subfamily-gender'], $_POST['submit-gender-gender']);
            $data = [
                'order-updated' => $_POST['submit-order-gender'],
                'family-updated' => $_POST['submit-family-gender'],
                'subfamily-updated' => $_POST['submit-subfamily-gender'],
                'gender-updated' => $_POST['submit-gender-gender']
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

    public function showPlantsGenderForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/PlantModel.php';
            require_once 'model/GenderModel.php';
            $plantModel = new PlantModel();
            $genderModel = new GenderModel();
            $plantModel = new PlantModel();
            $plantsGender = $plantModel->listPlant($_POST['gender-plant']);
            if (is_array($plantsGender)) {
                $plantsGender = json_encode($plantsGender);
            }
            $plantsGenderArray = json_decode($plantsGender, true);
            $plants = $plantModel->getPlants();
            $ids = array(); // Arreglo para almacenar los IDs

            foreach ($plantsGenderArray as $plant) {
                $id = $plant['id_planta']; // Suponiendo que el ID está en la clave 'id', ajusta esto según la estructura de tu JSON
                $ids[] = $id; // Agregar el ID al arreglo $ids
            }
            $data = [
                'plants' => $plants,
                'plantsGender' => $ids,
                'gender' => $_POST['gender-plant'],
                'inputSearch' => $_POST['search-value'],
                'name-gender' => $genderModel->getGender($_POST['gender-plant'])
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("updateHostPlantsForGenderAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("updateHostPlantsForGenderSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updatePlantsGender()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/PlantModel.php';
            require_once 'model/GenderModel.php';
            $plantModel = new PlantModel();
            $genderModel = new GenderModel();
            $plantModel->deletePlantsGender($_POST['gender-plant']);

            if (isset($_POST['checkbox-plants'])) {
                foreach ($_POST['checkbox-plants'] as $plant) {
                    $genderModel->registerGenderPlant($_POST['gender-plant'], $plant);
                }
                $_POST['checkbox-plants'] = array();
            }

            $plantsGender = $plantModel->listPlant($_POST['gender-plant']);
            if (is_array($plantsGender)) {
                $plantsGender = json_encode($plantsGender);
            }
            $plantsGenderArray = json_decode($plantsGender, true);
            $plants = $plantModel->getPlants();
            $ids = array(); // Arreglo para almacenar los IDs

            foreach ($plantsGenderArray as $plant) {
                $id = $plant['id_planta']; // Suponiendo que el ID está en la clave 'id', ajusta esto según la estructura de tu JSON
                $ids[] = $id; // Agregar el ID al arreglo $ids
            }
            $data = [
                'plants' => $plants,
                'plantsGender' => $ids,
                'gender' => $_POST['gender-plant'],
                'inputSearch' => $_POST['search-value'],
                'name-gender' => $genderModel->getGender($_POST['gender-plant']),
                'updated' => true
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("updateHostPlantsForGenderAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("updateHostPlantsForGenderSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSearchGenderSpecies()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchGenderSpeciesEmptyAdminView.php", NULL);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchGenderSpeciesEmptySuperuserView.php", NULL);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchGenderSpeciesEmptyUserView.php", null);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSearchGenderSpeciesForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $orders['orders'] = $orderModel->getOrders();
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchGenderSpeciesForUpdateEmptyAdminView.php", $orders);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchGenderSpeciesForUpdateEmptySuperuserView.php", $orders);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function listGenderSpecies()
    {
        if (isset($_SESSION['role'])) {
            require 'model/GenderModel.php';

            $genderModel = new GenderModel();

            $genders = $genderModel->listGenderSpecies($_POST['inputSearch']);
            $data = [
                'gendersSpecies' => $genders,
                'inputSearch' => $_POST['inputSearch']
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchGerderSpeciesAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchGerderSpeciesSuperuserView.php", $data);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchGerderSpeciesUserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function listGenderSpeciesForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require 'model/GenderModel.php';
            require_once 'model/OrderModel.php';
            $genderModel = new GenderModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $genders = $genderModel->listGenderSpecies($_POST['inputSearch']);
            $data = [
                'gendersSpecies' => $genders,
                'inputSearch' => $_POST['inputSearch'],
                'orders' => $orders
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchGenderSpeciesForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchGenderSpeciesForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

}

?>