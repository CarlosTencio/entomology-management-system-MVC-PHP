<?php
session_start();

class IndexController
{

    public function __construct()
    {
        $this->view = new View();
    } // constructor


    public function showIndex()
    {
        session_destroy();
        require 'model/UserModel.php';
        $userModel = new UserModel();
        $result = $userModel->verifySuperUser('superuser');
        if ($result == true) {
            $this->view->show("indexView.php", null);
        } else {
            $userModel->registerSuperUser('superuser', 'superuser',4);
            $this->view->show("indexView.php", null);
        }

    } // showIndex  



    public function showLoginSuperuser()
    {
        session_destroy();
        $this->view->show("showloginsuperuserView.php", null);
    } //showLoginSuperuser


    public function showSuperuser()
    {
        $this->view->show("showSuperuserMainView.php", null);
    } //showLoginSuperuser 

} //class IndexController

?>