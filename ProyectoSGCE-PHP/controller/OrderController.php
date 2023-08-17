<?php

session_start();
class OrderController
{

    public function __construct()
    {
        $this->view = new View();
    } //

    public function searchOrders()
    {
        require 'model/OrderModel.php';
        $orderModel = new OrderModel();
        $query = $_GET['name'];
        $orders = $orderModel->searchOrders($query);
        echo json_encode($orders);
    }


    public function showSearchOrderForUpdate()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchOrderForUpdateAdminEmptyView.php", null);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchOrderForUpdateSuperuserEmptyView.php", null);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function searchOrderForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $orders = $orderModel->searchOrder($_POST['order']);
            $data = [
                'orders' => $orders,
                'name' => $_POST['order']
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchOrderForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchOrderForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showRegisterOrderAdmin()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerOrderAdminView.php", NULL);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerOrderSuperuserView.php", NULL);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function registerOrder()
    {
        require 'model/OrderModel.php';
        require_once 'model/AuditModel.php';
        $orderModel = new OrderModel();
        $auditModel = new AuditModel();
        $description = "Registró orden: " . $_POST['name'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $orderModel = new OrderModel();
        $response = $orderModel->registerOrder($_POST['name']);
        echo json_encode($response);
    }

    public function registerOrderAdmins()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/OrderModel.php';
            require_once 'model/AuditModel.php';
            $orderModel = new OrderModel();
            $auditModel = new AuditModel();
            $description = "Registró orden: " . $_POST['name-order'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $response = $orderModel->registerOrder($_POST['name-order']);

            $data = [
                'order-registered' => $_POST['name-order']
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("registerOrderAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerOrderSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updateOrder()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/OrderModel.php';
            require_once 'model/AuditModel.php';
            $orderModel = new OrderModel();
            $auditModel = new AuditModel();
            $description = "Actualizó orden: " . $_POST['name-order'];
            $auditModel->registerAudit($description, $_SESSION['username']);
            $response = $orderModel->updateOrder($_POST['id-order'], $_POST['name-order']);

            $data = [
                'order-updated' => $_POST['name-order']
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchOrderForUpdateAdminEmptyView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchOrderForUpdateSuperuserEmptyView.php", $data);
            }

        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function getOrders()
    {
        require 'model/OrderModel.php';
        $orderModel = new OrderModel();
        $orders['orders'] = $orderModel->getOrders();
        echo json_encode($orders);
    }

  

    public function showListOrders()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchOrderAdminEmptyView.php", NULL);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchOrderSuperuserEmptyView.php", NULL);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("searchOrderUserEmptyView.php", NULL);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function ListOrdersAsc()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $lista['lista'] = $orderModel->showAllOrdersAsc($_POST['order']);
            $array = array(
                'lista' => $lista['lista'],
                'name' => $_POST['order']
            );
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchOrderAdminView.php", $array);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchOrderSuperuserView.php", $array);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show('searchOrderUserView.php', $array);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function ListOrdersDesc()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $lista['lista'] = $orderModel->showAllOrdersDesc($_POST['order']);
            $array = array(
                'lista' => $lista['lista'],
                'name' => $_POST['order']
            );
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchOrderAdminView.php", $array);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchOrderSuperuserView.php", $array);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show('searchOrderUserView.php', $array);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function showGenderOrder()
    {
        if (isset($_SESSION['role'])) {
            require 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $lista['lista'] = $orderModel->showGenderOrder($_POST['order']);
            if ($_SESSION['role'] == 2) {
                $this->view->show("listGenderOrderAdminView.php", $lista);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("listGenderOrderSuperuserView.php", $lista);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show('listGenderOrderUserView.php', $lista);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

}
?>