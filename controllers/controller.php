<?php
include_once '../models/db.php';
include "../boostrap.php";

class Controller
{
    public $data = 'tawjih';

    // functions of controller

    public function dataProfile($email, $password)
    {
        $db = new Db();
        $res = $db->selectDb("SELECT s.codeMassar,s.cin,s.email,s.firstName,s.lastName,s.firstNameArabe,s.lastNameArabe,s.photo,s.sex,s.bacYear,s.phone,s.parentPhone,s.address,s.placeBirth,s.dateBirth,b.sector,l.nameFr,c.name,r.name,s.attachment_cin,s.attachment_releve,s.attachment_diplome,s.idBac,s.idCity,s.idRegion,s.idLycee FROM students s
                JOIN bac b on b.idBac = s.idBac
                JOIN city c on c.idCity = s.idCity
                JOIN region r on r.idRegion = s.idRegion
                JOIN lycee l on l.idLycee = s.idLycee 
                where s.email='$email' and s.password='$password'");
        
        // get all bacs :
        $bacs = $db->selectDb("SELECT * from bac");
        $arrayBacs = array();
        while ($rowBacs = $bacs->fetch()) {              
            $arrayBacs[] = "<option value='$rowBacs[0]'>$rowBacs[1]</option>";
        }

        // get all City :
        $City = $db->selectDb("SELECT * from city ORDER BY name");
        $arrayCity = array();
        while ($rowCity = $City->fetch()) {              
            $arrayCity[] = "<option value='$rowCity[0]'>$rowCity[1]</option>";
        }
        
        // get all Region :
        $Region = $db->selectDb("SELECT * from region");
        $arrayRegion = array();
        while ($rowRegion = $Region->fetch()) {              
            $arrayRegion[] = "<option value='$rowRegion[0]'>$rowRegion[1]</option>";
        }
        // get all Lycee :
        $Lycee = $db->selectDb("SELECT * from lycee");
        $arrayLycee = array();
        while ($rowLycee = $Lycee->fetch()) {              
            $arrayLycee[] = "<option value='$rowLycee[0]'>$rowLycee[1]</option>";
        }

        if ($res) {
            $row = $res->rowCount();
            $info = $res->fetch();
            if ($row == 1) {
                $data = array(
                    'codeMassar' => "$info[0]",
                    'cin' => "$info[1]",
                    'email' => "$info[2]",
                    'firstName' => "$info[3]",
                    'lastName' => "$info[4]",
                    'firstNameArabe' => "$info[5]",
                    'lastNameArabe' => "$info[6]",
                    'photo' => "$info[7]",
                    'sex' => "$info[8]",
                    'bacYear' => "$info[9]",
                    'phone' => "$info[10]",
                    'parentPhone' => "$info[11]",
                    'address' => "$info[12]",
                    'placeBirth' => "$info[13]",
                    'dateBirth' => "$info[14]",

                    'bac' => "$info[15]",
                    'lycee' => "$info[16]",
                    'city' => "$info[17]",
                    'region' => "$info[18]",

                    'attachment_cin' => $info[19],
                    'attachment_releve' => $info[20],
                    'attachment_diplome' => $info[21],

                );
                $arrayBacs[] = "<option selected value='$info[22]'>$info[15]</option>";
                $arrayCity[] = "<option selected value='$info[23]'>$info[17]</option>";
                $arrayRegion[] = "<option selected value='$info[24]'>$info[18]</option>";
                $arrayLycee[] = "<option selected value='$info[25]'>$info[16]</option>";
                echo json_encode([
                    "result" => "success",
                    "data" => $data,
                    "bacs" => $arrayBacs,
                    "city" => $arrayCity,
                    "region" => $arrayRegion,
                    "lycee" => $arrayLycee,
                ]);
            } else {
                echo json_encode([
                    "result" => "no",                    
                ]);
            }
        } else {
            echo json_encode([
                "result" => "not god",                    
            ]);           
        }
    }
}
