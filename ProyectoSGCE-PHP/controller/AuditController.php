<?php
session_start();
class AuditController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function showListAudit()
    {
        if (isset($_SESSION['role'])) {
            require 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $lista['lista'] = $auditModel->getAudit();

            if ($_SESSION['role'] == 2) {
                $this->view->show("searchAuditAdminView.php", $lista);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchAuditSuperuserView.php", $lista);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //getCabinets

    public function listByYear()
    {
        if (isset($_SESSION['role'])) {
            require 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $lista['lista'] = $auditModel->getAuditYear($_POST['year']);
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchAuditAdminView.php", $lista);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchAuditSuperuserView.php", $lista);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
    public function listByDates()
    {
        if (isset($_SESSION['role'])) {
            require 'model/AuditModel.php';
            $auditModel = new AuditModel();
            $lista['lista'] = $auditModel->getAuditDate($_POST['initial-date'], $_POST['final-date']);
            if ($_SESSION['role'] == 2) {
                $this->view->show("searchAuditAdminView.php", $lista);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("searchAuditSuperuserView.php", $lista);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
}
