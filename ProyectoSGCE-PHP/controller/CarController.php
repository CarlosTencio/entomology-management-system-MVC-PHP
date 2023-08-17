<?php
session_start();

class CarController
{

    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function addToCarSuperuser()
    {
        require 'model/CarModel.php';
        $carModel = new CarModel();
        $reponse = $carModel->addToCarSuper($_POST['id'], $_POST['type'],$_POST['user']);
        echo json_encode($reponse);
    } // addToCar

    public function seeCar()
    {
        if (isset($_SESSION['role'])) {
        require 'model/CarModel.php';
        $carModel = new CarModel();
        $response['car'] = $carModel->seeCarSuperuser($_POST['user']);
        if ($_SESSION['role'] == 2) {
            $this->view->show("showCarAdminuserView.php", $response);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("showCarSuperuserView.php", $response);
        }else if ($_SESSION['role'] == 1) {
            $this->view->show("showCarUserView.php", $response);
        }
    }else{
        $this->view->show("indexView.php", null);
    }
    } // seeCar
       
    public function addToSeeSuperuser()
    {
        require 'model/CarModel.php';
        $carModel = new CarModel();
        $reponse = $carModel->addToSeeSuperuser($_POST['user'],$_POST['id'], $_POST['type']);
        echo json_encode($reponse);
    } // addToSee

    public function deleteFromCarSuperuser()
    {
        require 'model/CarModel.php';
        $carModel = new CarModel();
        $reponse = $carModel->deleteFromCarSuperuser($_POST['user'], $_POST['id'], $_POST['type']);
        echo json_encode($reponse);
    }

    public function getViews()
    {
        if (isset($_SESSION['role'])) {
        require 'model/CarModel.php';
        $carModel = new CarModel();
        $response['views'] = $carModel->getViewsSuperuser($_POST['user']);
        if ($_SESSION['role'] == 2) {
            $this->view->show("showViewsAdminView.php", $response);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("showViewsSuperuserView.php", $response);
        }else if ($_SESSION['role'] == 1) {
            $this->view->show("showViewsUserView.php", $response);
        }
    }else{
        $this->view->show("indexView.php", null);
    }
    }

    public function getViewsAdmin()
    {
        require 'model/CarModel.php';
        $carModel = new CarModel();
        $response['views'] = $carModel->getViewsSuperuser($_POST['superuser']);
        $this->view->show("showViewsAdminView.php", $response);
    }
    public function deleteFromViewsSuperuser()
    {
        require 'model/CarModel.php';
        $carModel = new CarModel();
        $reponse = $carModel->deleteFromViewsSuperuser($_POST['user'], $_POST['id'], $_POST['type']);
        echo json_encode($reponse);
    }

} // class
