<?php
session_start();

class SpecimenController
{

    public function __construct()
    {
        $this->view = new View();
    } // construct

    public function showRegisterSpecimenAdmin()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/GenderModel.php';
            require_once 'model/OrderModel.php';
            $genderModel = new GenderModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $genders = $genderModel->getAllGenders();
            $data = [
                'orders' => $orders,
                'genders' => $genders
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerSpecimenAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerSpecimenSuperUserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSpecimen()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/RecordModel.php';
            require_once 'model/PlantModel.php';
            $plantsModel = new PlantModel();
            $specimenModel = new SpecimenModel();
            $specimen = $specimenModel->getSpecimen($_POST['specimen']);
            $img = $specimenModel->getImages($_POST['specimen']);
            $plants = $plantsModel->listPlant($_POST['gender']);
            $data = [
                'specimen' => $specimen,
                'img' => $img,
                'plants' => $plants
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenSuperuserView.php", $data);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("showSpecimenUserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSpecimenForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/LocationModel.php';
            require_once 'model/OrderModel.php';
            $locationModel = new LocationModel();
            $specimenModel = new SpecimenModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $specimen = $specimenModel->getSpecimen($_POST['specimen']);
            $img = $specimenModel->getImages($_POST['specimen']);
            $locations = $locationModel->getCountries();
            $data = [
                'specimen' => $specimen,
                'img' => $img,
                'countries' => $locations,
                'orders' => $orders
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }


    public function showSpecimenAdmin()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SpecimenModel.php';
            $specimenModel = new SpecimenModel();
            $specimen['specimen'] = $specimenModel->getSpecimen($_POST['specimen']);

            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenAdminView.php", $specimen);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenSuperuserView.php", $specimen);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function sendImageSpecimen($name)
    {
        $uploadedFileNames = []; // Array que almacenará los nombres de los archivos subidos
        $uploadPath = './public/img/'; // Ruta de destino de los archivos subidos
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Extensiones permitidas
        $newFileName = $name; // Nuevo nombre personalizado para el archivo

        $counter = 0;
        foreach ($_FILES['select-imageFiles']['tmp_name'] as $key => $tmpName) {
            $file = $_FILES['select-imageFiles'];

            // Obtener la extensión del archivo
            $extension = strtolower(pathinfo($file['name'][$key], PATHINFO_EXTENSION));

            // Verificar si la extensión es válida
            if (in_array($extension, $allowedExtensions)) {
                // Generar la ruta de destino con el nuevo nombre
                $newFilePath = $uploadPath . $newFileName . $counter . ".jpg";

                if (move_uploaded_file($tmpName, $newFilePath)) {
                    // Agregar el nombre del archivo al array de nombres subidos
                    $uploadedFileNames[] = $newFilePath;
                }
            } else {
                // El archivo tiene una extensión no permitida, puedes mostrar un mensaje de error o realizar alguna acción adicional
                echo 'Archivo no válido: ' . $file['name'][$key];
            }
            $counter++;
        }
        return $uploadedFileNames;
    }

    public function registerSpecimen()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/OrderModel.php';
            $orderModel = new OrderModel();
            $orders['orders'] = $orderModel->getOrders();
            $specimenModel = new SpecimenModel();
            $response = $specimenModel->registerSpecimen(
                $_POST['select-gender'],
                $_POST['select-species'],
                $_POST['select-type'],
                $_POST['select-storage'],
                $_POST['select-drawer'],
                $_POST['select-district'],
                $_POST['select-date'],
                $_POST['select-collector']
            );

            $lastIndex = $response;
            $img = $lastIndex . $_POST['select-gender'] . $_POST['select-species'] . $_POST['select-district'] . $_POST['select-date'];
            $imageNames = $this->sendImageSpecimen($img);
            foreach ($imageNames as $index => $uploadedName) {
                $specimenModel->registerImg($uploadedName, $lastIndex);
            }
            $data = [
                'orders' => $orders,
                'registered' => "registrado"
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("registerSpecimenAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("registerSpecimenSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updateTagSpecimen()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/LocationModel.php';
            require_once 'model/OrderModel.php';
            $locationModel = new LocationModel();
            $specimenModel = new SpecimenModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $specimenModel->updateTagSpecimen(
                $_POST['submit-tag'],
                $_POST['select-district'],
                $_POST['submit-date'],
                $_POST['submit-collector']
            );

            $specimen = $specimenModel->getSpecimen($_POST['submit-specimen-tag']);
            $img = $specimenModel->getImages($_POST['submit-specimen-tag']);
            $locations = $locationModel->getCountries();
            $data = [
                'specimen' => $specimen,
                'img' => $img,
                'countries' => $locations,
                'orders' => $orders,
                'updated' => 'updated'
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //updateTagSpecimen

    public function updateLocationSpecimen()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/LocationModel.php';
            require_once 'model/OrderModel.php';
            $locationModel = new LocationModel();
            $specimenModel = new SpecimenModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $specimenModel->updateLocationSpecimen(
                $_POST['submit-specimen-storage'],
                $_POST['submit-storage'],
                $_POST['submit-drawer']
            );

            $specimen = $specimenModel->getSpecimen($_POST['submit-specimen-storage']);
            $img = $specimenModel->getImages($_POST['submit-specimen-storage']);
            $locations = $locationModel->getCountries();
            $data = [
                'specimen' => $specimen,
                'img' => $img,
                'countries' => $locations,
                'orders' => $orders,
                'updated' => 'updated'
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function updateTaxSpecimen()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/LocationModel.php';
            require_once 'model/OrderModel.php';
            $locationModel = new LocationModel();
            $specimenModel = new SpecimenModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $specimenModel->updateTaxSpecimen(
                $_POST['submit-specimen-tax'],
                $_POST['select-gender'],
                $_POST['select-species']
            );

            $specimen = $specimenModel->getSpecimen($_POST['submit-specimen-tax']);
            $img = $specimenModel->getImages($_POST['submit-specimen-tax']);
            $locations = $locationModel->getCountries();
            $data = [
                'specimen' => $specimen,
                'img' => $img,
                'countries' => $locations,
                'orders' => $orders,
                'updated' => 'updated'
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //updateTagSpecimen

    public function updateImages()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/LocationModel.php';
            require_once 'model/OrderModel.php';
            $locationModel = new LocationModel();
            $specimenModel = new SpecimenModel();
            $orderModel = new OrderModel();
            $orders = $orderModel->getOrders();
            $specimen = $specimenModel->getSpecimen($_POST['submit-specimen']);
            $newimg = $specimen[0]['id_especimen'] .
                $specimen[0]['id_genero'] .
                $specimen[0]['id_especie'] .
                $specimen[0]['id_distrito'] .
                $specimen[0]['fecha'] . 'actualizado';
            $imageNames = $this->sendImageSpecimen($newimg);
            foreach ($imageNames as $index => $uploadedName) {
                $specimenModel->registerImg($uploadedName, $_POST['submit-specimen']);
            }
            $img = $specimenModel->getImages($_POST['submit-specimen']);
            $locations = $locationModel->getCountries();
            $data = [
                'specimen' => $specimen,
                'img' => $img,
                'countries' => $locations,
                'orders' => $orders,
                'updated' => 'actualizado'
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function deleteImage()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/LocationModel.php';
            require_once 'model/OrderModel.php';
            $locationModel = new LocationModel();
            $specimenModel = new SpecimenModel();
            $orderModel = new OrderModel();

            $filePath = $_POST['submit-route'];

            if (file_exists($filePath)) {
                unlink($filePath); // Elimina el archivo
            }

            $specimenModel->deleteImg($_POST['submit-img']);
            $specimen = $specimenModel->getSpecimen($_POST['submit-specimen-delete']);
            $img = $specimenModel->getImages($_POST['submit-specimen-delete']);
            $locations = $locationModel->getCountries();
            $orders = $orderModel->getOrders();
            $data = [
                'specimen' => $specimen,
                'img' => $img,
                'countries' => $locations,
                'orders' => $orders,
                'img-deleted' => 'deleted'
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimenForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimenForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function deleteSpecimen()
    {
        if (isset($_SESSION['role'])) {
            require_once 'model/SpecimenModel.php';
            require_once 'model/SpeciesModel.php';
            require_once 'model/OrderModel.php';

            $specimenModel = new SpecimenModel();
            $specieModel = new SpeciesModel();
            $img = $specimenModel->getImages($_POST['submit-specimen']);
            $specimen = $specimenModel->getSpecimen($_POST['submit-specimen']);
            $specimenModel->deleteSpecimen($_POST['submit-specimen']);
            $specimens = $specimenModel->getSpecimens($specimen[0]['id_especie']);
            foreach ($img as $value) {
                if (file_exists($value['ruta_imagen'])) {
                    unlink($value['ruta_imagen']); // Elimina el archivo
                }
                $specimenModel->deleteImg($value['id_img']);
            }
            $data = [
                'name' => $_POST['search-value'],
                'specimens' => $specimens,
                'deleted' => 'deleted'
            ];

            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimensForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimensForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    } //deleteSpecimen


    public function showSpecimens()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SpecimenModel.php';
            $specimenModel = new SpecimenModel();
            $specimens = $specimenModel->getSpecimens($_POST['species']);

            if (isset($_POST['namespecies'])) {
                $specie = $_POST['namespecies'];
            } else {
                $specie = null;
            }
            $data = [
                'specimens' => $specimens,
                'name' => $specie
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimensAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimensSuperuserView.php", $data);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("showSpecimensUserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showSpecimensForUpdate()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SpecimenModel.php';
            $specimenModel = new SpecimenModel();
            $specimens = $specimenModel->getSpecimens($_POST['species']);

            if (isset($_POST['namespecies'])) {
                $specie = $_POST['namespecies'];
            } else {
                $specie = null;
            }
            $data = [
                'specimens' => $specimens,
                'name' => $specie
            ];
            if ($_SESSION['role'] == 2) {
                $this->view->show("showSpecimensForUpdateAdminView.php", $data);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showSpecimensForUpdateSuperuserView.php", $data);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }

    public function showLocationSpecimens()
    {
        if (isset($_SESSION['role'])) {
            require 'model/SpecimenModel.php';
            $specimenModel = new SpecimenModel();
            $specimen['specimen'] = $specimenModel->getLocations($_SESSION['username']);
            if ($_SESSION['role'] == 2) {
                $this->view->show("showLocationSpecimensAdminView.php", $specimen);
            } else if ($_SESSION['role'] == 4) {
                $this->view->show("showLocationSpecimensSuperuserView.php", $specimen);
            } else if ($_SESSION['role'] == 1) {
                $this->view->show("showLocationSpecimensUserView.php", $specimen);
            }
        } else {
            $this->view->show("indexView.php", null);
        }
    }
}