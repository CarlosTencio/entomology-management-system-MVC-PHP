<?php

session_start();


class UserController
{

    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function showRegisterUser()
    {
        if (isset($_SESSION['username'])) {
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerUserFromAdminView.php", null);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerUserFromSuperuserView.php", null);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } // showRegisterUser
    public function showRegisterAdmin()
    {
        if (isset($_SESSION['username'])) {
            $this->view->show("registerAdminSuperuserView.php", null);
        } else {
            $this->view->show("indexView.php", null);
        }
    } // showRegisterUser

    public function showInit()
    {
        if ($_SESSION['role'] == 2) {
            $this->view->show("showAdminView.php", null);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("showSuperuserMainView.php", null);
        } else if ($_SESSION['role'] == 1) {
            $this->view->show("showUserView.php", null);
        }
    }

    public function initSessionSuperuser()
    {
        if (isset($_POST['username'])) {
            require_once 'model/UserModel.php';
            require_once 'model/CarModel.php';
            $userModel = new UserModel();
            $carModel = new CarModel();
            $result = $userModel->initSessionSuperuser($_POST['username'], $_POST['password']);
            if ($result == 1) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['role'] = 4;
                $_SESSION['carGenders'] = $carModel->getIdsGendersCarSuperuser($_SESSION['username']);
                $_SESSION['carSpecies'] = $carModel->getIdsSpeciesCarSuperuser($_SESSION['username']);
                $_SESSION['viewsGenders'] = $carModel->getIdsGendersViewsSuperuser($_SESSION['username']);
                $_SESSION['viewsSpecies'] = $carModel->getIdsSpeciesViewsSuperuser($_SESSION['username']);
                $this->view->show("showSuperuserMainView.php", null);
            } else if ($result == null) {
                $data = [
                    'error' => "Usuario o contraseña incorrectos"
                ];
                $this->view->show("showloginsuperuserView.php", $data);
            } else {
                $data = [
                    'username' => $_POST['username']
                ];
                $this->view->show("changePasswordSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //initSessionSuperuser

    public function changePasswordSuperuser()
    {
        if (isset($_POST['username'])) {
            require_once 'model/UserModel.php';
            require_once 'model/UserModel.php';
            require_once 'model/CarModel.php';
            $userModel = new UserModel();
            $result = $userModel->changePasswordSuperuser($_POST['username'], $_POST['password']);
            $userModel = new UserModel();
            $carModel = new CarModel();
            $result = $userModel->initSessionSuperuser($_POST['username'], $_POST['password']);
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = 4;
            $_SESSION['carGenders'] = $carModel->getIdsGendersCarSuperuser($_SESSION['username']);
            $_SESSION['carSpecies'] = $carModel->getIdsSpeciesCarSuperuser($_SESSION['username']);
            $_SESSION['viewsGenders'] = $carModel->getIdsGendersViewsSuperuser($_SESSION['username']);
            $_SESSION['viewsSpecies'] = $carModel->getIdsSpeciesViewsSuperuser($_SESSION['username']);
            $data = [
                'success' => "Contraseña cambiada con éxito"
            ];
            $this->view->show("showSuperuserMainView.php", $data);
        } else {
            $this->view->show("indexView.php", null);
        }
    } //changePasswordSuperuser

    public function getUsers()
    {
        require_once 'model/UserModel.php';
        $userModel = new UserModel();
        $users['users'] = $userModel->getUsers();
        echo json_encode($users);
    } //getUsers


    public function initSessionUser()
    {
        require_once 'model/UserModel.php';
        require_once 'model/CarModel.php';
        $userModel = new UserModel();
        $carModel = new CarModel();
        $result = $userModel->initSessionUser($_POST['username'], $_POST['password']);

        if (
            $result == 1 || $result == 2
        ) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = 1;
            $_SESSION['carGenders'] = $carModel->getIdsGendersCarSuperuser($_SESSION['username']);
            $_SESSION['carSpecies'] = $carModel->getIdsSpeciesCarSuperuser($_SESSION['username']);
            $_SESSION['viewsGenders'] = $carModel->getIdsGendersViewsSuperuser($_SESSION['username']);
            $_SESSION['viewsSpecies'] = $carModel->getIdsSpeciesViewsSuperuser($_SESSION['username']);
            $this->view->show("showUserView.php", null);
        } else if ($result == 3) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = 2;
            $_SESSION['carGenders'] = $carModel->getIdsGendersCarSuperuser($_SESSION['username']);
            $_SESSION['carSpecies'] = $carModel->getIdsSpeciesCarSuperuser($_SESSION['username']);
            $_SESSION['viewsGenders'] = $carModel->getIdsGendersViewsSuperuser($_SESSION['username']);
            $_SESSION['viewsSpecies'] = $carModel->getIdsSpeciesViewsSuperuser($_SESSION['username']);
            $this->view->show("showAdminView.php", null);
        } else if ($result == 0 || $result == 4) {
            $data = [
                'error' => "Usuario o contraseña incorrectos"
            ];
            $this->view->show("indexView.php", $data);
        }
    } //initSessionSuperuser

    public function registerUser()
    {
        require_once 'model/UserModel.php';
        require_once 'model/AuditModel.php';
        $userModel = new UserModel();
        $auditModel = new AuditModel();
        $description = "Registró usuario: " . $_POST['username'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $result = $userModel->registerUser($_POST['username'], $_POST['password'], $_POST['role']);
        if ($result == true) {
            $this->view->show("registerUserFromSuperuserView.php", null);
        } else {
            $this->view->show("registerUserFromSuperuserView.php", null);
        }
    } //registerUse
    public function registerUserAdmins()
    {
        require_once 'model/UserModel.php';
        require_once 'model/AuditModel.php';
        $userModel = new UserModel();
        $auditModel = new AuditModel();
        $description = "Registró usuario: " . $_POST['username'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $result = $userModel->registerUser($_POST['username'], $_POST['password'], $_POST['role']);
        $data['user-registered'] = $_POST['username'];
        if ($_SESSION['role'] == 2) {
            $this->view->show("registerUserFromAdminView.php", $data);
        } else if ($_SESSION['role'] == 4) {
            $this->view->show("registerUserFromSuperuserView.php", $data);
        }
    } //registerUserFromAdmin

    public function registerAdmin()
    {
        require_once 'model/UserModel.php';
        require_once 'model/AuditModel.php';
        $userModel = new UserModel();
        $auditModel = new AuditModel();
        $description = "Registró admin: " . $_POST['username'];
        $auditModel->registerAudit($description, $_SESSION['username']);
        $result = $userModel->registerAdmin($_POST['username'], $_POST['password'], 3);
        $data['user-registered'] = $_POST['username'];
        $this->view->show("registerAdminSuperuserView.php", $data);
    } //registerUser
    public function showManageUser()
    {
        require 'model/UserModel.php';
        $userModel = new UserModel();
        $userList['users'] = $userModel->listUser();
        $this->view->show("manageUserSuperuserView.php", $userList);
    }
    public function activateUser()
    {
        require 'model/UserModel.php';
        $userModel = new UserModel();
        $result = $userModel->activateUser($_POST['id_usuario']);
        $userList['users'] = $userModel->listUser();
        $this->view->show("manageUserSuperuserView.php", $userList);
    }
} //class UserController
