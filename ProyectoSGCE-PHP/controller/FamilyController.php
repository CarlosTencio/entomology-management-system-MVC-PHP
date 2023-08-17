<?php
session_start();
class FamilyController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getFamilies()
    {
        require 'model/FamilyModel.php';
        $familyModel = new FamilyModel();
        $families['families'] = $familyModel->getFamilies($_POST['order']);
        echo json_encode($families);
    } //getFamilies

    public function getAllFamilies()
    {
        require 'model/FamilyModel.php';
        $familyModel = new FamilyModel();
        $families['families'] = $familyModel->getAllFamilies();
        echo json_encode($families);
    } //getFamilies

    public function showRegisterFamilyAdmin()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $orders['orders'] = $orderModel->getOrders();
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerFamilyAdminView.php", $orders);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerFamilySuperuserView.php", $orders);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSearchFamilyForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $orders['orders'] = $orderModel->getOrders();

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchFamiliesForUpdateAdminEmptyView.php", $orders);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchFamiliesForUpdateSuperuserEmptyView.php", $orders);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function searchFamilyForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require 'model/FamilyModel.php';
            require 'model/OrderModel.php';
            $familyModel = new FamilyModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $families = $familyModel->searchFamily($_POST['family']);
            $data = [
                'families' => $families,
                'orders' => $orders,
                'name' => $_POST['family']
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchFamiliesForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchFamiliesForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }


    public function registerFamily()
    {
        require_once 'model/FamilyModel.php';
        require_once 'model/AuditModel.php';
        $auditModel = new AuditModel();
        $description = "Registró familia: " . $_POST['family'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $familyModel = new FamilyModel();
        $response = $familyModel->registerFamily($_POST['family'], $_POST['order']);
        echo json_encode($response);
    }

    public function registerFamilyAdmins()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/FamilyModel.php';
            require_once 'model/OrderModel.php';
            require_once 'model/AuditModel.php';
            $orderModel = new OrderModel();
            $auditModel = new AuditModel();
            $familyModel = new FamilyModel();
            $description = "Registró familia: " . $_POST['name-family'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $orders['orders'] = $orderModel->getOrders();
            $orders = $orderModel->getOrders();
            $response = $familyModel->registerFamily($_POST['name-family'], $_POST['select-order']);
            $data = [
                'order-registered' => $_POST['name-order'],
                'family-registered' => $_POST['name-family'],
                'orders' => $orders
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerFamilyAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerFamilySuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updateFamily()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/FamilyModel.php';
            require_once 'model/AuditModel.php';
            require 'model/OrderModel.php';
            $familyModel = new FamilyModel();
            $orderModel = new OrderModel();
            $familyModel = new FamilyModel();
            $auditModel = new AuditModel();
            $description = "Actualizó familia: " . $_POST['id-family'];
            $orders = $orderModel->getOrders();
            $auditModel->registerAudit($description, $_SESSION['username']);
            $response = $familyModel->updateFamily($_POST['id-family'], $_POST['name-family'], $_POST['select-order']);
            $data = [
                'order-updated' => $_POST['submit-order'],
                'family-updated' => $_POST['name-family'],
                'orders' => $orders
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchFamiliesForUpdateAdminEmptyView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchFamiliesForUpdateSuperuserEmptyView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }

    }

    public function showListFamilies()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchFamiliesAdminEmptyView.php", NULL);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchFamiliesSuperuserEmptyView.php", NULL);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchFamiliesUserEmptyView.php", NULL);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function ListFamiliesAsc()
    {
        if (isset($_SESSION['role'])) {
            require 'model/FamilyModel.php';
            $familyModel = new FamilyModel();
            $family = $_POST['family'];
            $lista['lista'] = $familyModel->showAllFamiliesAsc($_POST['family']);
            $array = array(
                'lista' => $lista['lista'],
                'name' => $family
            );
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchFamiliesAdminView.php", $array);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchFamiliesSuperuserView.php", $array);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchFamiliesUserView.php", $array);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function ListFamiliesDesc()
    {
        if (isset($_SESSION['role'])) {
            require 'model/FamilyModel.php';
            $familyModel = new FamilyModel();
            $family = $_POST['family'];
            $lista['lista'] = $familyModel->showAllFamiliesDesc($_POST['family']);
            $array = array(
                'lista' => $lista['lista'],
                'name' => $family
            );
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchFamiliesAdminView.php", $array);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchFamiliesSuperuserView.php", $array);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchFamiliesUserView.php", $array);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function showGenderFamily()
    {
        if (isset($_SESSION['role'])) {
            require 'model/FamilyModel.php';
            $familyModel = new FamilyModel();
            $lista['lista'] = $familyModel->showGenderFamily($_POST['family']);
            if ($_SESSION['role'] == 2) {
                $this->view->show("listGenderFamilyAdminView.php", $lista);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("listGenderFamilySuperuserView.php", $lista);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("listGenderFamilyUserView.php", $lista);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

}
?>