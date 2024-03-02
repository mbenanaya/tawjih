<?php
include "../models/db.php";
include "../boostrap.php";

$db = new Db();

if (isset($_GET['codeMassar_student'])) {
    $codeMassar_student = htmlspecialchars($_GET['codeMassar_student']);
    $check = $db->selectDb("SELECT * FROM requests WHERE id_student='$codeMassar_student' AND state IN('en-cours','refuse')");
    if ($check) {
        if ($check->rowCount() == 0) {
            $res = $db->updateDb("INSERT INTO requests(id_student) VALUES('$codeMassar_student')");
            if ($res > 0) {
                echo "submited";
            } else {
                echo "error";
            }
        } else {
            echo "already sent";
        }
    } else {
        echo "error";
    }
}

if (isset($_GET['request_state_student'])) {
    $id = $_GET['id_student_state'];
    $res = $db->selectDb("SELECT state FROM requests,students WHERE students.codeMassar='$id' AND requests.id_student = students.codeMassar");
    if ($res) {
        while ($row = $res->fetch()) {
            echo $row['state'];
        }
    } else {
        echo "error";
    }
}

if (isset($_GET['list_request'])) {
    $res = $db->selectDb("SELECT * FROM requests,students WHERE requests.id_student = students.codeMassar");
    if ($res) {
        if ($res->rowCount() === 0) {
            echo "no request";
        } else {
            while ($row = $res->fetch()) {
                $state = '';
                $color = '';
                $d_delete = 'none';
                if ($row['state'] == "en-cours") {
                    $state = "En attente";
                    $color = "badge-primary";
                } else if ($row['state'] == "accept") {
                    $state = "Accepté";
                    $color = "badge-success";
                } else if ($row['state'] == "refuse") {
                    $state = "Refusé";
                    $color = "badge-danger";
                    $d_delete = "inline";
                } else if ($row['state'] == "done") {
                    $state = "Terminé";
                    $color = "badge-secondary";
                }
                echo "<li class='position-relative booking'>
                    <div class='media'>
                        <div class='msg-img'>
                            <img src='" . BASE_URL . '/' . $row['photo'] . "' alt=''>
                        </div>
                        <div class='media-body'>
                            <h5 class='mb-4'>" . $row['firstName'] . ' ' . $row['lastName'] . "<span class='badge $color mx-3'>$state</span><a class='btn-gray mr-2 delete' style='cursor: pointer;display:$d_delete;' value=" . $row['id'] . "><i class='far fa-times-circle mr-2'></i> supprimer</a></h5>
                            <div class='mb-3'>
                                <span class='mr-2 d-block d-sm-inline-block mb-2 mb-sm-0'>Date de demande:</span>
                                <span class='bg-light-blue'>" . $row['date_request'] . "</span>
                            </div>                        
                            <div class='mb-5'>
                                <span class='mr-2 d-block d-sm-inline-block mb-1 mb-sm-0'>Étudiant:</span><br/>
                                <span class='border-right pr-2 mr-2'>" . $row['firstName'] . ' ' . $row['lastName'] . "</span>
                                <span class='border-right pr-2 mr-2'>" . $row['email'] . "</span>
                                <span>" . $row['phone'] . "</span>
                            </div>                            
                        </div>
                    </div>
                    <div class='buttons-to-right'>
                        <a class='btn-gray mr-2 refuser' style='cursor: pointer;' value=" . $row['id'] . "><i class='far fa-times-circle mr-2'></i> refuser</a>
                        <a class='btn-gray accepter' style='cursor: pointer;' value=" . $row['id'] . "><i class='far fa-check-circle mr-2'></i>accepter </a>
                    </div>
                </li>";
            }
        }
    } else {
        echo "error";
    }
}

if (isset($_GET['accepter_id'])) {
    $id = $_GET['accepter_id'];
    $res = $db->updateDb("UPDATE requests SET state='accept' WHERE id=$id");
    if ($res > 0) {
        echo "accept";
    } else {
        echo "error";
    }
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $res = $db->updateDb("DELETE FROM requests WHERE id=$id");
    if ($res > 0) {
        echo "delete";
    } else {
        echo "error";
    }
}
if (isset($_GET['refuser_id'])) {
    $id = $_GET['refuser_id'];
    $res = $db->updateDb("UPDATE requests SET state='refuse' WHERE id=$id");
    if ($res > 0) {
        echo "refuse";
    } else {
        echo "error";
    }
}

if (isset($_POST["update_info"]) && isset($_POST["inputCne"])) {
    $cne = $_POST["inputCne"];
    $old = $db->selectDb("SELECT * FROM students WHERE codeMassar='$cne'");
    $oldrow = $old->fetch();
    
    $photo_profile_new_name = "";
    if (!empty($_FILES["photo_profile"]['name'])) {
        $photo_profile_name =  $_FILES["photo_profile"]['name'];
        $photo_profile_type =  $_FILES["photo_profile"]['type'];
        $photo_profile_tmp_name =  $_FILES["photo_profile"]['tmp_name'];

        if(!$oldrow["photo"] == ''){
            unlink("../".$oldrow["photo"]);
        }
        

        $profile_new_name =  uniqid() . $photo_profile_name;  
        $photo_profile_new_name =  "profile_images/".$profile_new_name;
        move_uploaded_file($photo_profile_tmp_name, "../profile_images/".$profile_new_name);
    } else {
        $photo_profile_new_name = $oldrow["photo"];
    }

    $relve_notes_new_name = "";
    if (!empty($_FILES["relve_notes"]["name"])) {
        $relve_notes_name =  $_FILES["relve_notes"]['name'];
        $relve_notes_type =  $_FILES["relve_notes"]['type'];
        $relve_notes_tmp_name =  $_FILES["relve_notes"]['tmp_name'];

        if(!$oldrow["attachment_releve"] == ''){
            unlink("../".$oldrow["attachment_releve"]);
        }        

        $relve_notes_new_name =  "uploads/attachment_student/".uniqid().$relve_notes_name;        
        move_uploaded_file($relve_notes_tmp_name, "../".$relve_notes_new_name);
    } else {
        $relve_notes_new_name = $oldrow["attachment_releve"];
    }

    $diplom_doc_new_name = "";
    if (!empty($_FILES["diplom_doc"]["name"])) {
        $diplom_doc_name =  $_FILES["diplom_doc"]['name'];
        $diplom_doc_type =  $_FILES["diplom_doc"]['type'];
        $diplom_doc_tmp_name =  $_FILES["diplom_doc"]['tmp_name'];

        if(!$oldrow["attachment_diplome"] == ''){        
            unlink("../".$oldrow["attachment_diplome"]);
        }

        $diplom_doc_new_name = "uploads/attachment_student/".uniqid() . $diplom_doc_name;        
        move_uploaded_file($diplom_doc_tmp_name, "../".$diplom_doc_new_name);
    } else {
        $diplom_doc_new_name = $oldrow["attachment_diplome"];
    }

    $carte_cin_new_name = "";
    if (!empty($_FILES["carte_cin"]["name"])) {
        $carte_cin_name =  $_FILES["carte_cin"]['name'];
        $carte_cin_type =  $_FILES["carte_cin"]['type'];
        $carte_cin_tmp_name =  $_FILES["carte_cin"]['tmp_name'];

        if(!$oldrow["attachment_cin"] == ''){
            unlink("../".$oldrow["attachment_cin"]);
        }        

        $carte_cin_new_name = "uploads/attachment_student/".uniqid() . $carte_cin_name;        
        move_uploaded_file($carte_cin_tmp_name, "../".$carte_cin_new_name);
    } else {
        $carte_cin_new_name = $oldrow["attachment_cin"];
    }

    $inputLastNameArab = htmlspecialchars($_POST["inputLastNameArab"]);
    $inputFirstNameArab = htmlspecialchars($_POST["inputFirstNameArab"]);
    $inputFirstNameFR = htmlspecialchars($_POST["inputFirstNameFR"]);
    $inputLastNameFR = htmlspecialchars($_POST["inputLastNameFR"]);
    $date_n = htmlspecialchars($_POST["date_n"]);
    $inputLocation = htmlspecialchars($_POST["inputLocation"]);
    $number_Cin = htmlspecialchars($_POST["number_Cin"]);
    $inputBacYear = htmlspecialchars($_POST["inputBacYear"]);
    $inputPhone = htmlspecialchars($_POST["inputPhone"]);
    $inputPhoneParent = htmlspecialchars($_POST["inputPhoneParent"]);
    $inputAdress = htmlspecialchars($_POST["inputAdress"]);

    $inputsector = htmlspecialchars($_POST["inputsector"]);
    $region = htmlspecialchars($_POST["region"]);
    $city = htmlspecialchars($_POST["city"]);
    $lycee = htmlspecialchars($_POST["lycee"]);
    
    //$inputEmail = htmlspecialchars($_POST["inputEmail"]);

    $res = $db->updateDb("UPDATE students SET
        cin='$number_Cin',firstName='$inputFirstNameFR',
        lastName='$inputLastNameFR',firstNameArabe='$inputFirstNameArab',
        lastNameArabe='$inputLastNameArab',photo='$photo_profile_new_name',
        bacYear='$inputBacYear',phone='$inputPhone',parentPhone='$inputPhoneParent',
        idBac=$inputsector, idRegion=$region, idCity=$city,  idLycee=$lycee,
        address='$inputAdress',placeBirth='$inputLocation',dateBirth='$date_n',attachment_cin='$carte_cin_new_name',
        attachment_releve='$relve_notes_new_name',attachment_diplome='$diplom_doc_new_name' WHERE codeMassar='$cne'");
    if ($res > 0) {
        echo "update";
        $res = $db->updateDb("DELETE FROM requests WHERE id_student='$cne'");            
    } else {
        echo "non update";
    }
}
