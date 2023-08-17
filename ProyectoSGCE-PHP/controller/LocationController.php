<?php
session_start();
class LocationController
{
    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function getCountries()
    {
        require 'model/LocationModel.php';
        $locationModel = new LocationModel();
        $countries['countries'] = $locationModel->getCountries();
        echo json_encode($countries);
    } //getCountries

    public function getProvinces()
    {
        require 'model/LocationModel.php';
        $locationModel = new LocationModel();
        $provinces['provinces'] = $locationModel->getProvinces($_POST['country']);
        echo json_encode($provinces);
    } //getProvinces

    public function getCantons(){
        require 'model/LocationModel.php';
        $locationModel = new LocationModel();
        $cantons['cantons'] = $locationModel->getCantons($_POST['province']);
        echo json_encode($cantons);
    } //getCantons

    public function getDistricts(){
        require 'model/LocationModel.php';
        $locationModel = new LocationModel();
        $districts['districts'] = $locationModel->getDistricts($_POST['canton']);
        echo json_encode($districts);
    }
    


}

?>