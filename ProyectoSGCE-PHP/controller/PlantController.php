<?php

session_start();
class PlantController
{

    public function __construct()
    {
        $this->view = new View();
    } //

    public function showListGenderPlant()
    {
        if (isset($_SESSION['role'])) {
            require 'model/PlantModel.php';
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchHostPlantEmptyAdminView.php", NULL);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchHostPlantEmptySuperuserView.php", NULL);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchHostPlantEmptyUserView.php", NULL);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //showListGenderPlant

    public function showSearchPlantForUpdate()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchHostPlantForUpdateEmptyAdminView.php", NULL);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchHostPlantForUpdateEmptySuperuserView.php", NULL);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //showListGenderPlant

    public function showRegisterPlantAdmin()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerPlantAdminView.php", null);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerPlantSuperuserView.php", null);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //showRegisterPlantAdmin

    public function registerPlantAdmins()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/PlantModel.php';
            $plantModel = new PlantModel();
            $response = $plantModel->registerPlant($_POST['name-plant']);
            $data = [
                'plant-registered' => $_POST['name-plant']
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerPlantAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerPlantSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updatePlant()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/PlantModel.php';
            $plantModel = new PlantModel();

            $response = $plantModel->updatePlant($_POST['id-plant'], $_POST['name-plant']);
            $data = [
                'plant-updated' => $_POST['name-plant']
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchHostPlantForUpdateEmptyAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchHostPlantForUpdateEmptySuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function listGenderPlant()
    {
        if (isset($_SESSION['role'])) {
            require 'model/PlantModel.php';
            $plantModel = new PlantModel();
            $plant = $_POST['plant'];
            $lista['lista'] = $plantModel->listGenderSpecies($_POST['plant']);
            $array = array(
                'lista' => $lista['lista'],
                'name' => $plant
            );
            $hostPlant['hostPlant'] = $plantModel->listGenderSpecies($_POST['plant']);
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchHostPlantAdminView.php", $array);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchHostPlantSuperuserView.php", $array);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchHostPlantUserView.php", $array);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function searchPlantForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require 'model/PlantModel.php';
            $plantModel = new PlantModel();
            $plants = $plantModel->searchPlants($_POST['plant']);

            $data = [
                'name' => $_POST['plant'],
                'plants' => $plants
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchHostPlantForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchHostPlantForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }



    public function getAllPlants()
    {
        require 'model/PlantModel.php';
        $plantModel = new PlantModel();
        $plants['plants'] = $plantModel->getPlants();
        echo json_encode($plants);
    }




}


?>