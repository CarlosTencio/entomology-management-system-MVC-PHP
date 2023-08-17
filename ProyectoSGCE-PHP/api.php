<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   //search for orderasc
   if (isset($_GET['order'])) {
      require_once 'libs/configuration.php';
      require 'model/OrderModel.php';
      $orderModel = new OrderModel();
      $lista['lista'] = $orderModel->showAllOrdersAsc($_GET['order']);
      header("HTTP/1.1 200 ok");
      echo json_encode($lista);
   } else if (isset($_GET['order-desc'])) {
      require_once 'libs/configuration.php';
      require 'model/OrderModel.php';
      $orderModel = new OrderModel();
      $lista['lista'] = $orderModel->showAllOrdersDesc($_GET['order-desc']);
      header("HTTP/1.1 200 ok");
      echo json_encode($lista);
   }
   //search for family asc
   if (isset($_GET['family'])) {
      require_once 'libs/configuration.php';
      require 'model/FamilyModel.php';
      $familyModel = new FamilyModel();
      $lista['lista'] = $familyModel->showAllFamiliesAsc($_GET['family']);
      header("HTTP/1.1 200 ok");
      echo json_encode($lista);
   } elseif (isset($_GET['family-desc'])) {
      require_once 'libs/configuration.php';
      require 'model/FamilyModel.php';
      $familyModel = new FamilyModel();
      $lista['lista'] = $familyModel->showAllFamiliesDesc($_GET['family-desc']);
      header("HTTP/1.1 200 ok");
      echo json_encode($lista);
   }

   if (isset($_GET['subfamily'])) {
      require_once 'libs/configuration.php';
      require 'model/SubfamilyModel.php';
      $subfamilyModel = new SubfamilyModel();
      $lista['lista'] = $subfamilyModel->showAllSubfamiliesAsc($_GET['subfamily']);
      header("HTTP/1.1 200 ok");
      echo json_encode($lista);
   } elseif (isset($_GET['subfamily-desc'])) {
      require_once 'libs/configuration.php';
      require 'model/SubfamilyModel.php';
      $subfamilyModel = new SubfamilyModel();
      $lista['lista'] = $subfamilyModel->showAllSubfamiliesDesc($_GET['subfamily-desc']);
      header("HTTP/1.1 200 ok");
      echo json_encode($lista);
   }

   if (isset($_GET['plant'])) {
      require_once 'libs/configuration.php';
      require 'model/PlantModel.php';
      $plant = new PlantModel();
      $lista['lista'] = $plant->listGenderSpecies($_GET['plant']);
      header("HTTP/1.1 200 ok");
      echo json_encode($lista);
   }

   if (isset($_GET['gender'])) {
      require_once 'libs/configuration.php';
      require 'model/GenderModel.php';
      $genderModel = new GenderModel();
      $genders['genders'] = $genderModel->listGenderSpecies($_GET['gender']);

      header("HTTP/1.1 200 ok");
      echo json_encode($genders);
   }
   if (isset($_GET['species'])) {
      require_once 'libs/configuration.php';
      require 'model/SpeciesModel.php';
      $speciesModel = new SpeciesModel();
      $species['species'] = $speciesModel->getSpeciesByName($_GET['species']);
      header("HTTP/1.1 200 ok");
      echo json_encode($species);
   }
   if (isset($_GET['specimens'])) {
      require_once 'libs/configuration.php';
      require 'model/SpecimenModel.php';
      $specimenModel = new SpecimenModel();
      $specimens['specimens'] = $specimenModel->getSpecimens($_GET['specimens']);
      header("HTTP/1.1 200 ok");
      echo json_encode($specimens);
   }

   //para mostrar el especimen es esto
   if (isset($_GET['specimen'])) {
      require_once 'libs/configuration.php';
      require 'model/SpecimenModel.php';
      $specimenModel = new SpecimenModel();
      $specimen['specimen'] = $specimenModel->getSpecimen($_GET['specimen']);
      header("HTTP/1.1 200 ok");
      echo json_encode($specimen);
   }
   if (isset($_GET['specimenImg'])) {
      require_once 'libs/configuration.php';
      require 'model/SpecimenModel.php';
      $specimenModel = new SpecimenModel();
      $img['img'] = $specimenModel->getImages($_GET['specimenImg']);
      header("HTTP/1.1 200 ok");
      echo json_encode($img);
   }
   if (isset($_GET['plantsGender'])) {
      require_once 'libs/configuration.php';
      require_once 'model/PlantModel.php';
      $plantsModel = new PlantModel();
      $plants['plants'] = $plantsModel->listPlant($_GET['plantsGender']);
      header("HTTP/1.1 200 ok");
      echo json_encode($plants);
   }

}
?>