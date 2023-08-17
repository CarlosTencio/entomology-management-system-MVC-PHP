<?php
session_start();
class SubfamilyController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getSubfamilies()
    {
        require 'model/SubfamilyModel.php';
        $subfamilyModel = new SubfamilyModel();
        $subfamilies['subfamilies'] = $subfamilyModel->getSubfamilies($_POST['family']);
        echo json_encode($subfamilies);
    } //getSubfamilies

    public function getAllSubfamilies()
    {
        require 'model/SubfamilyModel.php';
        $subfamilyModel = new SubfamilyModel();
        $subfamilies['subfamilies'] = $subfamilyModel->getAllSubfamilies();
        echo json_encode($subfamilies);
    } //getSubfamilies

    public function showRegisterSubfamilyAdmin()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $orders['orders'] = $orderModel->getOrders();
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerSubfamilyAdminView.php", $orders);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerSubfamilySuperuserView.php", $orders);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSearchSubfamilyForUpdate()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchSubfamiliesForUpdateAdminEmptyView.php", null);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchSubfamiliesForUpdateSuperuserEmptyView.php", null);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function registerSubfamily()
    {
        require 'model/SubfamilyModel.php';
        require_once 'model/AuditModel.php';
        $auditModel = new AuditModel();
        $description = "Registró subfamilia: " . $_POST['subfamily'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $subfamilyModel = new SubfamilyModel();
        $response = $subfamilyModel->registerSubfamily($_POST['subfamily'], $_POST['family']);
        echo json_encode($response);
    }

    public function registerSubfamilyAdmins()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SubfamilyModel.php';
            require_once 'model/OrderModel.php';
            require_once 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $orderModel = new OrderModel();
            $subfamilyModel = new SubfamilyModel();
            $description = "Registró familia: " . $_POST['name-family'];
            $auditModel->registerAudit($description, $_SESSION['username']);

            $orders = $orderModel->getOrders();

            $response = $subfamilyModel->registerSubfamily($_POST['name-subfamily'], $_POST['select-family']);
            $data = [
                'order-registered' => $_POST['name-order'],
                'family-registered' => $_POST['name-family'],
                'subfamily-registered' => $_POST['name-subfamily'],
                'orders' => $orders
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerSubfamilyAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerSubfamilySuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updateSubfamily()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SubfamilyModel.php';
            require_once 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $subfamilyModel = new SubfamilyModel();
            $description = "Actualizó subfamilia: " . $_POST['id-subfamily'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $response = $subfamilyModel->updateSubfamily($_POST['id-subfamily'], $_POST['name-subfamily'], $_POST['select-family']);

            $data = [
                'order-updated' => $_POST['submit-order'],
                'family-updated' => $_POST['submit-family'],
                'subfamily-updated' => $_POST['name-subfamily']
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchSubfamiliesForUpdateAdminEmptyView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchSubfamiliesForUpdateSuperuserEmptyView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function searchSubfamilyForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SubfamilyModel.php';
            require_once 'model/AuditModel.php';
            require_once 'model/OrderModel.php';

            $orderModel = new OrderModel();
            $subfamilyModel = new SubfamilyModel();

            $orders = $orderModel->getOrders();
            $subfamily = $_POST['subfamily'];
            $subfamilies = $subfamilyModel->searchSubfamily($subfamily);
            $data = [
                'orders' => $orders,
                'subfamilies' => $subfamilies,
                'name' => $subfamily
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchSubfamiliesForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchSubfamiliesForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showListSubfamilies()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SubfamilyModel.php';
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchSubfamiliesAdminEmptyView.php", NULL);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchSubfamiliesSuperuserEmptyView.php", NULL);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchSubfamiliesUserEmptyView.php", NULL);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function ListSubfamiliesAsc()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SubfamilyModel.php';
            $subfamiliesModel = new SubfamilyModel();
            $subfamily = $_POST['subfamily'];
            $lista['lista'] = $subfamiliesModel->showAllSubfamiliesAsc($_POST['subfamily']);
            $array = array(
                'lista' => $lista['lista'],
                'name' => $subfamily
            );
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchSubfamiliesAdminView.php", $array);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchSubfamiliesSuperuserView.php", $array);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchSubfamiliesUserView.php", $array);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function ListSubfamiliesDesc()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SubfamilyModel.php';
            $subfamiliesModel = new SubfamilyModel();
            $subfamily = $_POST['subfamily'];
            $lista['lista'] = $subfamiliesModel->showAllSubfamiliesDesc($_POST['subfamily']);
            $array = array(
                'lista' => $lista['lista'],
                'name' => $subfamily
            );
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchSubfamiliesAdminView.php", $array);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchSubfamiliesSuperuserView.php", $array);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchSubfamiliesUserView.php", $array);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
}

?>