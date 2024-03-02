<?php
include "../models/db.php";
include "../boostrap.php";

$db = new Db();

// crud bac :

if (isset($_GET['crud_bac'])) {
    $res = $db->selectDb("SELECT * from bac ORDER BY idBac");
    if ($res) {
        while ($row = $res->fetch()) {
            echo "<tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td class='text-center'>
                            <button class='update_bac text-light btn' value='$row[0]'><input type='hidden' value='$row[1]'/><input type='hidden' value='$row[2]'/>" . "<i class='bx bx-pencil fs-4' style='color: #0401c1;font-size: 20px;'></i> " . "</button>
                            <button class='delete text-light btn' value='$row[0]'>" . "<i class='fa-solid fa-trash-can' style='color: #d80e0e;font-size: 20px;'></i>" . "</button></td>
                        </td>
                    </tr>";
        }
    }
}

// delete bac
if (isset($_GET['id_bac_delete'])) {
    $id = $_GET['id_bac_delete'];
    $r = $db->updateDb("DELETE from bac WHERE idBac= $id");
    if ($r > 0) {
        echo 'delete';
    } else {
        echo 'not delete';
    }
}

// update bac
if (isset($_GET['id_bac_update'])) {
    $id = $_GET['id_bac_update'];
    $filierAr = $_GET['filierAr'];
    $filierFr = $_GET['filierFr'];
    $r = $db->updateDb("UPDATE bac SET sector='$filierAr', sectorFR='$filierFr'  WHERE idBac= $id");
    if ($r > 0) {
        echo 'update';
    } else if ($r == 0) {
        echo 'not update';
    }
}

// add bac 
if (isset($_GET['add_bac'])) {
    $bacAr = $_GET['filierAr'];
    $bacFr = $_GET['filierFr'];
    $r = $db->updateDb("INSERT INTO bac(sector,sectorFR) VALUES('$bacAr', '$bacFr')");
    if ($r > 0) {
        echo 'added';
    } else {
        echo 'not add';
    }
}


// crud region
if (isset($_GET['crud_region'])) {
    $res = $db->selectDb("SELECT * from region ORDER BY idRegion");
    if ($res) {
        while ($row = $res->fetch()) {
            echo "<tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td class='text-center'>
                            <button class='update_region text-light btn' value='$row[0]'><input type='hidden' value='$row[1]'/>" . "<i class='bx bx-pencil fs-4' style='color: #0401c1;font-size: 20px;'></i> " . "</button>
                            <button class='delete text-light btn' value='$row[0]'>" . "<i class='fa-solid fa-trash-can' style='color: #d80e0e;font-size: 20px;'></i>" . "</button></td>
                        </td>
                    </tr>";
        }
    }
}

// total region
if (isset($_GET['total_region'])) {
    $res = $db->selectDb("SELECT COUNT(*) from region");
    if ($res) {
        $total = $res->fetch();
        echo $total[0];
    }
}

// delete region
if (isset($_GET['id_region_delete'])) {
    $id = $_GET['id_region_delete'];
    $r = $db->updateDb("DELETE from region WHERE idRegion= $id");
    if ($r > 0) {
        echo 'delete';
    } else {
        echo 'not delete';
    }
}

// update region
if (isset($_GET['id_region_update'])) {
    $id = $_GET['id_region_update'];
    $nameRegion = $_GET['nameRegion'];
    $r = $db->updateDb("UPDATE region SET name='$nameRegion' WHERE idRegion= $id");
    if ($r > 0) {
        echo 'update';
    } else if ($r == 0) {
        echo 'not update';
    }
}

// add region 
if (isset($_GET['add_region'])) {
    $region = $_GET['region'];
    $r = $db->updateDb("INSERT INTO region(name) VALUES('$region')");
    if ($r > 0) {
        echo 'added';
    } else {
        echo 'not add';
    }
}


// crud ville
if (isset($_GET['crud_ville'])) {
    $res = $db->selectDb("SELECT city.idCity,city.name,region.name,region.idRegion from city, region WHERE city.idRegion=region.idRegion ORDER BY idRegion");
    if ($res) {
        while ($row = $res->fetch()) {
            echo "<tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td class='text-center'>
                            <button class='update_ville text-light btn' value='$row[0]'><input type='hidden' value='$row[1]'/><input type='hidden' value='$row[2]'/><input type='hidden' value='$row[3]'/>" . "<i class='bx bx-pencil fs-4' style='color: #0401c1;font-size: 20px;'></i> " . "</button>
                            <button class='delete text-light btn' value='$row[0]'>" . "<i class='fa-solid fa-trash-can' style='color: #d80e0e;font-size: 20px;'></i>" . "</button></td>
                        </td>
                    </tr>";
        }
    }
}

// total villes
if (isset($_GET['total_villes'])) {
    $res = $db->selectDb("SELECT COUNT(*) from city");
    if ($res) {
        $total = $res->fetch();
        echo $total[0];
    }
}

// delete ville
if (isset($_GET['id_ville_delete'])) {
    $id = $_GET['id_ville_delete'];
    $r = $db->updateDb("DELETE from city WHERE idCity = $id");
    if ($r > 0) {
        echo 'delete';
    } else {
        echo 'not delete';
    }
}

// update ville
if (isset($_GET['regionParVille'])) {
    $oldId = $_GET['oldRegion'];
    $r = $db->selectDb("SELECT * FROM region where idRegion != $oldId");
    if ($r) {
        while ($row = $r->fetch()) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }
}

if (isset($_GET['id_ville_update'])) {
    $id = $_GET['id_ville_update'];
    $nameVille = $_GET['nameVille'];
    $newRegion = $_GET['newRegion'];
    $r = $db->updateDb("UPDATE city SET name='$nameVille', idRegion=$newRegion WHERE idCity= $id");
    if ($r > 0) {
        echo 'update';
    } else if ($r == 0) {
        echo 'not update';
    }
}
//////////////////////////////////////////////////////////////////////////////////////

// add ville
if (isset($_GET['Allregions'])) {
    $res = $db->selectDb("SELECT * FROM region");
    if ($res) {
        while ($row = $res->fetch()) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }
}

if (isset($_GET['add_ville'])) {
    $ville = $_GET['ville'];
    $region = $_GET['region'];
    $res = $db->updateDb("INSERT INTO city(name,idRegion) VALUES('$ville',$region)");
    if ($res > 0) {
        echo 'added';
    } else {
        echo 'not add';
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// crud lycee
if (isset($_GET['crud_lycee'])) {
    $res = $db->selectDb("SELECT * from lycee ORDER BY idLycee");
    if ($res) {
        while ($row = $res->fetch()) {
            echo "<tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td>$row[3]</td>
                        <td class='text-center'>
                            <button class='update_lycee text-light btn' value='$row[0]'><input type='hidden' value='$row[1]'/><input type='hidden' value='$row[2]'/><input type='hidden' value='$row[3]'/>" . "<i class='bx bx-pencil fs-4' style='color: #0401c1;font-size: 20px;'></i> " . "</button>
                            <button class='delete text-light btn' value='$row[0]'>" . "<i class='fa-solid fa-trash-can' style='color: #d80e0e;font-size: 20px;'></i>" . "</button></td>
                        </td>
                    </tr>";
        }
    }
}

// total lycee
if (isset($_GET['total_lycees'])) {
    $res = $db->selectDb("SELECT COUNT(*) from lycee");
    if ($res) {
        $total = $res->fetch();
        echo $total[0];
    }
}

// delete lycee
if (isset($_GET['id_lycee_delete'])) {
    $id = $_GET['id_lycee_delete'];
    $r = $db->updateDb("DELETE from lycee WHERE idLycee = $id");
    if ($r > 0) {
        echo 'delete';
    } else {
        echo 'not delete';
    }
}

// update lycee
if (isset($_GET['id_lycee_update'])) {
    $id = $_GET['id_lycee_update'];
    $nameFrLycee = $_GET['nameFrLycee'];
    $nameArLycee = $_GET['nameArLycee'];
    $adresse = $_GET['adresse'];
    $r = $db->updateDb("UPDATE lycee SET nameFr='$nameFrLycee', nameAr='$nameArLycee', addressFr='$adresse' WHERE idLycee= $id");
    if ($r > 0) {
        echo 'update';
    } else if ($r == 0) {
        echo 'not update';
    }
}

// add lycee
if (isset($_GET['add_lycee'])) {
    $nameFrLycee = $_GET['nameFrLycee'];
    $nameArLycee = $_GET['nameArLycee'];
    $adresse = $_GET['adresse'];
    $res = $db->updateDb("INSERT INTO lycee(nameFr,nameAr,addressFr) VALUES('$nameFrLycee','$nameArLycee','$adresse')");
    if ($res > 0) {
        echo 'added';
    } else {
        echo 'not add';
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// crud établissement
if (isset($_GET['crud_etablissement'])) {
    $res = $db->selectDb("SELECT * from establishments ORDER BY id");
    if ($res) {
        while ($row = $res->fetch()) {
            echo "<tr>
                        <td><img id='logo' src='". $row[4] ."' alt='' class='avatar-sm rounded-circle me-2' /><a href='#' class='text-body'></a></td>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td>$row[3]</td>
                        <td class='text-center'>
                            <button class='update_etablissement text-light btn' value='$row[0]'><input type='hidden' value='$row[1]'/><input type='hidden' value='$row[2]'/><input type='hidden' value='$row[3]'/><input type='hidden' value='$row[4]'/>" . "<i class='bx bx-pencil fs-4' style='color: #0401c1;font-size: 20px;'></i> " . "</button>
                            <button class='delete text-light btn' value='$row[0]'><input type='hidden' value='$row[4]'/>" . "<i class='fa-solid fa-trash-can' style='color: #d80e0e;font-size: 20px;'></i>" . "</button></td>
                        </td>
                    </tr>";
        }
    }
}

// total établissement
if (isset($_GET['total_etablissement'])) {
    $res = $db->selectDb("SELECT COUNT(*) from establishments");
    if ($res) {
        $total = $res->fetch();
        echo $total[0];
    }
}

// delete etablissement
if (isset($_GET['id_etablissement_delete'])) {
    $id = $_GET['id_etablissement_delete'];
    $path_logo = $_GET['path_logo'];
    $delete = unlink("../".$path_logo);
    if ($delete) {
        $r = $db->updateDb("DELETE from establishments WHERE id = $id");
        if ($r > 0) {
            echo 'delete';
        } else {
            echo 'not delete';
        }
    }
}

// show old data for update :
if (isset($_GET['update_establishment_id'])) {
    $id = $_GET['update_establishment_id'];
    $res = $db->selectDb("SELECT * FROM establishments where id=$id");
    if ($res) {
        while ($row = $res->fetch()) {
            echo json_encode($row);
        }
    }
}

// update etablissement
if (isset($_POST['id_etablissement_update'])) {
    $id = htmlspecialchars($_POST['id_etablissement_update']);
    $libelle = htmlspecialchars($_POST['libelle_update']);
    $filieres = htmlspecialchars($_POST['Filieres_update']);
    $last_deadline = htmlspecialchars($_POST['last_deadline_update']);
    $name = htmlspecialchars($_FILES['logo_update']['name']);
    $type = htmlspecialchars($_FILES['logo_update']['type']);
    $tmp_name = htmlspecialchars($_FILES['logo_update']['tmp_name']);

    $old_logo = $_POST['old_logo'];
    
    if (empty($tmp_name)) {
        $r = $db->updateDb("UPDATE establishments SET title='$libelle', sector='$filieres', last_deadline='$last_deadline' WHERE id= $id");
        if ($r > 0) {
            echo 'update';
        } else if ($r == 0) {
            echo 'not update';
        }
    } else {
        // Load the source image based on its MIME type
       /*  $imageInfo = getimagesize($tmp_name);
        $mimeType = $imageInfo['mime'];

        switch ($mimeType) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/jpg':
                $source = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/png':
                $source = imagecreatefrompng($tmp_name);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($tmp_name);
                break;
                // Add support for other image types if needed
            default:
                // Invalid or unsupported image type
                exit('Invalid image type. Only JPEG, PNG and GIF are supported.');
        } */

        // Create a blank canvas for the new JPG image
        //$destination = imagecreatetruecolor(imagesx($source), imagesy($source));

        // Copy the source image onto the canvas, converting it to JPG format
        //imagecopy($destination, $source, 0, 0, 0, 0, imagesx($source), imagesy($source));

        // Save the new JPG image
        $new_name =  uniqid() . $name;
        $destinationImage = "uploads/logo-establishments/".$new_name;
        //imagejpeg($destination, $destinationImage, 90);

        // Clean up resources
        /* imagedestroy($source);
        imagedestroy($destination); */

        // Move the uploaded file to the desired location
        move_uploaded_file($tmp_name, "../uploads/logo-establishments/".$new_name);
        $r = $db->updateDb("UPDATE establishments SET logo='$destinationImage', title='$libelle', sector='$filieres', last_deadline='$last_deadline' WHERE id= $id");
        if ($r > 0) {
            echo 'update';
            unlink("../".$old_logo);
        } else if ($r == 0) {
            echo 'not update';
        }
    }
}

// add etablissement
if ((isset($_POST['libelle'])) && (isset($_POST['last_deadline'])) && (isset($_POST['Filieres'])) && (isset($_FILES['logo']))) {
    $libelle = htmlspecialchars($_POST['libelle']);
    $filieres = htmlspecialchars($_POST['Filieres']);
    $last_deadline = htmlspecialchars($_POST['last_deadline']);
    $name = htmlspecialchars($_FILES['logo']['name']);
    $type = htmlspecialchars($_FILES['logo']['type']);
    $tmp_name = htmlspecialchars($_FILES['logo']['tmp_name']);

    // Save the new JPG image
    $new_name =  uniqid() . $name;
    $destinationImage = "uploads/logo-establishments/" . $new_name;
    move_uploaded_file($tmp_name,"../uploads/logo-establishments/" . $new_name);

    $res = $db->updateDb("INSERT INTO establishments(logo,title,sector,last_deadline) VALUES('$destinationImage','$libelle','$filieres','$last_deadline')");
    if ($res > 0) {
        echo 'added';
    } else {
        echo 'not add';
    }
}

// get data Stripe
if(isset($_POST['stripeUpdate']) == "requestDataStripe"){       
    $res = $db->selectDb("SELECT * FROM stripe_account");
    if($res){
        if($res->rowCount() == 0){
            echo json_encode([
                'resultat' => 'stripe empty'
            ]);
        }else{
            $data = $res->fetch(PDO::FETCH_OBJ);
            echo json_encode([
                'resultat' => 'stripe full',
                "stripeDtata" => $data
            ]);
        }    
    }    
}
// update data Stripe
if(isset($_POST['id_stripe']) && isset($_POST['publishable_key']) && isset($_POST['secret_key'])){
            
    $id = htmlspecialchars($_POST['id_stripe']);
    $publishable_key = htmlspecialchars($_POST['publishable_key']);
    $secret_key = htmlspecialchars($_POST['secret_key']);

    $check = $db->selectDb("SELECT * FROM stripe_account");
    if($check){
        if($check->rowCount() == 0){
            $ins = $db->updateDb("INSERT INTO stripe_account(secret_key,publishable_key) VALUES('$secret_key','$publishable_key')");
            if($ins > 0){
                echo "stripe updated";
            }else{
                echo "stripe not updated";
            }            
        }else{
            $res = $db->updateDb("UPDATE stripe_account SET secret_key='$secret_key', publishable_key='$publishable_key' WHERE id= $id");
            if($res > 0){
                echo "stripe updated";
            }else{
                echo "stripe not updated";
            }
        }
    }else{
        echo "stripe not updated";
    }
   
}
