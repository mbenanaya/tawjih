<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/Pays.php';

class PaysController
{
	private $pays;

    public function __construct()
    {
        $this->pays = new Pays;
    }

    public function addCountry($nomPays, $nomPaysFr, $imagePays, $description)
    {
        $image_name = $imagePays['name'];
        $tmp_image = $imagePays['tmp_name'];
        $image_path = '../uploads/etranger/pays';
        $new_image_name = $nomPaysFr.'_'.$image_name;
        $pos_image = $image_path.'/'.$new_image_name;
        move_uploaded_file($tmp_image, $pos_image);

        $result = $this->pays->addCountry($nomPays, $nomPaysFr, $new_image_name, $description);


        if ($result === 'already exist') {
            $response = ['exists'=> true, 'exMessage' => 'Ce pays deja trouve.Veuillez entrer un autre'];
        } elseif ($result === 'added') {
            $response = ['success'=> true, 'message' => 'Pays ajouté avec succès'];
        } else {
            $response = ['error'=> true, 'message' => 'Une erreur est survenue !!'];
        }
        
        header('Content-Type: application/json'); 
        echo json_encode($response);
    }

    public function getAllCountries()
    {
        $output = '';
        $countries = $this->pays->getAllCountries();
        
        if (empty($countries)) {
            $output .= '<div class="text-center fs-1 fw-semibold mt-5">لا توجد معلومات</div>';
        } else {
            foreach ($countries as $country) {
                $id      = $country['idPays']; 
                $nomPays     = $country['nomPays'];
                $nomPaysFr   = $country['nomPaysFr'];
                $imagePays   = $country['imagePays'];
                $description = $country['description'];

                $output .= '
                    <div class="col-12 col-sm-10 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <div class="card h-100">
                            <a href="pays?id='.$id.'" class="image-article">
                                <img src="./uploads/etranger/pays/'.$imagePays.'" alt="" class="card-img-top" height="250px">
                            </a>
                            <a href="pays?id='.$id.'" class="etr card-body text-center d-flex flex-column">
                                <h3 class="text-dark">الدراسة في '.$nomPays.'</h3>
                                <span class="text-center text-dark"> <strong> '.$description.' </strong></span>
                            </a>
                        </div>
                    </div>
                ';
            }
        }
        echo $output;
    }

    public function showCountries()
    {
        header('Content-Type: application/json');
        $output = '';
        $countries = $this->pays->getAllCountries();
        
        if (empty($countries)) {
            $output .= '<div class="text-center fs-1 fw-semibold mt-5">لا توجد معلومات</div>';
            echo json_encode(array('message' => $output));
        } else {
            echo json_encode($countries);
        }
    }

    public function getCountForArticles()
    {
        header('Content-Type: application/json');
        $countries = $this->pays->getAllCountries();
        
        echo json_encode($countries);
    }

    public function getCountriesNumber()
    {
        $count = $this->pays->getCountriesNumber();
        $data = ['count' => $count];
        echo json_encode($data);
    }

    public function getCountryById($idPays)
    {
        header('Content-Type: application/json');
        $result = $this->pays->getCountryById($idPays);
        echo json_encode($result);
    }

    public function getCountryName($idPays)
    {
        header('Content-Type: application/json');
        $result = $this->pays->getCountryById($idPays);
        $nom = $result['nomPays'];
        echo json_encode($nom);
    }

    public function updateCountry($id, $nomPays, $nomPaysFr, $imagePays, $description) {

        $oldImage = $this->pays->getCountryById($id)['imagePays'];

        if (!empty($oldImage)) {
            $image_path = '../uploads/etranger/pays/';
            $oldImagePath = $image_path . $oldImage;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $image_name = $imagePays['name'];
        $tmp_image = $imagePays['tmp_name'];
        $new_image_name = $nomPaysFr . '_' . $image_name;
        $pos_image = $image_path . $new_image_name;
        move_uploaded_file($tmp_image, $pos_image);

        $update = $this->pays->updateCountry($id, $nomPays, $nomPaysFr, $new_image_name, $description);

        if ($update) {
            $response = ['success' => true, 'message' => 'Le pays a été mis à jour avec succès.'];
        } else {
            $response = ['error' => true, 'message' => 'Une erreur est survenue !!'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);

    }

    public function deleteCountry($idPays) {

        $countryImage = $this->pays->getCountryById($idPays)['imagePays'];
        $deleted = $this->pays->deleteCountry($idPays);

        if (!empty($countryImage)) {
            $image_path = '../uploads/etranger/pays/';
            $countryImagePath = $image_path . $countryImage;
            if (file_exists($countryImagePath)) {
                $imageRemoved = unlink($countryImagePath);
            }
        }

        if ($deleted && $imageRemoved) {
            $response = ['success' => true, 'message' => 'Le pays supprimé avec succès.'];
        } else {
            $response = ['error' => true, 'message' => 'Une erreur est survenue !!'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getAbroadArticle()
    {
        $output = '';
        $countries = $this->pays->getAllCountries();
        
        if (empty($countries)) {
            $output .= '<div class="text-center fs-1 fw-semibold mt-5">لا توجد معلومات</div>';
        } else {
            foreach ($countries as $country) {
                $nomPays     = $country['nomPays'];
                $nomPaysFr   = $country['nomPaysFr'];
                $imagePays   = $country['imagePays'];
                $description = $country['description'];

                $output .= '
                    <div class="cont col-12 col-sm-10 col-md-6 col-lg-4 col-xl-4 mb-4">
                        <div class="card h-100">
                            <a href="pays/'.$nomPaysFr.'" target="_blank" class="image-article">
                                <img src="./uploads/etranger/pays/'.$imagePays.'" alt="" class="card-img-top" height="250px">
                            </a>
                            <a href="pays/'.$nomPaysFr.'" target="_blank" class="etr card-body text-center d-flex flex-column">
                                <h3 class="text-dark">الدراسة في '.$nomPays.'</h3>
                                <span class="text-center text-dark"> <strong> '.$description.' </strong></span>
                            </a>
                        </div>
                    </div>
                ';
            }
        }
        echo $output;
    }

    public function validation($data){
        $data= trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}

$paysContr = new PaysController;

if (isset($_POST['action']) && $_POST['action'] == 'getAllCountries') {
    $paysContr->getAllCountries();
}

if (isset($_POST['addNewC'])) {
    $nomPays = $paysContr->validation($_POST['nomPays']);
    $nomPaysFr = $paysContr->validation($_POST['nomPaysFr']);
    $description = $paysContr->validation($_POST['description']);

    $imagePays = $_FILES['imagePays'];

    $paysContr->addCountry($nomPays, $nomPaysFr, $imagePays, $description);
}

if (isset($_POST['action']) && $_POST['action'] == 'showCountries') {
	$paysContr->showCountries();
}

if (isset($_POST['action']) && $_POST['action'] == 'getCount') {
    $paysContr->getCountriesNumber();
}

if (isset($_POST['idPaysUpdate']) && isset($_POST['action']) && $_POST['action'] == 'getCountryById') {
    $idPaysUpdate = $_POST['idPaysUpdate'];
    $paysContr->getCountryById($idPaysUpdate);
}

if (isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == 'getPayName') {
    $idPays = $_POST['id'];
    $paysContr->getCountryName($idPays);
}

if (isset($_POST['updCountry'])) {
    $idPaysUpdate = $_POST['idPaysUpdate'];
    $nomPaysUpdate = $paysContr->validation($_POST['nomPaysUpdate']);
    $nomPaysFrUpdate = $paysContr->validation($_POST['nomPaysFrUpdate']);
    $descriptionUpdate = $paysContr->validation($_POST['descriptionUpdate']);

    $imagePays = $_FILES['imagePaysUpdate'];

    $paysContr->updateCountry($idPaysUpdate, $nomPaysUpdate, $nomPaysFrUpdate, $imagePays, $descriptionUpdate);
}

if (isset($_POST['idPaysDelete']) && isset($_POST['action']) && $_POST['action'] == 'deleteCountry') {
    $idPaysDelete = $_POST['idPaysDelete'];
    $paysContr->deleteCountry($idPaysDelete);
}

if (isset($_POST['action']) && $_POST['action'] == 'getCountriesNames') {
    $paysContr->getCountForArticles();
}