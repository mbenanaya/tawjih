<?php
session_start();
include "../models/db.php";
include "./controller.php";

require './includes/Exception.php';
require './includes/PHPMailer.php';
require './includes/SMTP.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$db = new Db();
$c = new Controller();

// Get Bac Years Dynamically
if (isset($_POST['action']) && $_POST['action'] == 'getBacYears') {
    $currentYear = date('Y');
    $yearRange = range($currentYear, $currentYear - 4);
    $output = '';
    $output .= '<label for="bacYear" class="form-label">سنة الباكالوريا</label>';
    $output .= '<select class="form-select mb-2" name="bacYear" id="bacYear">';
    $output .= '<option selected disabled>اختر سنة الباكالوريا</option>';

    foreach ($yearRange as $year) {
        $output .= '<option value="' . $year . '">' . $year . '</option>';
    }
    $output .= '</select>';
    echo $output;
}

// answer of signup form
if (isset($_POST['signup'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars(trim($_POST['password']));
        
        // Generate token and expiration date
        $token = bin2hex(random_bytes(16));
        $expiry_date = date('Y-m-d H:i:s', strtotime('+1 day'));

        $res = $db->selectDb("SELECT * from students where email='$email'");
        $count = $res->rowCount();
        if ($count != 0) {
            echo 'Cet email existe déjà!';
        } else {

            // Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            // Server settings                    
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'mohamedouahki22@gmail.com'; // SMTP username
            $mail->Password = 'aduiyioyzeszrvbk'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = "UTF-8";
            // Recipients
            $mail->setFrom('mohamedouahki22@gmail.com','Tawjih');
            $mail->addAddress($email); // Add a recipient

            // Attachments
            /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */// Optional name
            // Content
            $link = "http://localhost/tawjihwebsite/complete-profile/" . urlencode($email) . "/" . $token;


            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Activation et connexion Tawjih';
            $mail->Body = "
                <p><b>Activation compte Tawjih</b></p>
                <p> Votre compte a été créé avec succès ! </p>
                <p> Information de connexion : <br/>
                Email :  $email <br/>
                Mot de passe : <b>$password</b> <br/></p>
                <p> Pour compléter et activer votre compte, veuillez cliquer sur le lien suivant : </p>
                <p><a href='".$link."'> Activation et connexion</a>  </p>   
                <p> Votre lien d'activation expirera le $expiry_date </p>
                Merci !";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->send()) {
                echo 'Message has been sent';
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $id_student = rand(time(),1000000);
                $db->selectDb("INSERT INTO students (codeMassar, id_student, email, password, token, token_expiry_date) VALUES ('123456789', '$id_student', '$email', '$password', '$token', '$expiry_date')");
            } else {
                echo "Le message n'a pas pu être envoyé!";
            }
        }
    }
}

// send email contact
if (isset($_GET['email_contact'])) {
         // get email dynamic form database
        $website = $db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);
        $email = filter_var($_GET['email_contact'], FILTER_SANITIZE_EMAIL);
        $first_name  = htmlspecialchars(trim($_GET['first_name']));
        $last_name = htmlspecialchars(trim($_GET['last_name']));
        $message = htmlspecialchars(trim($_GET['message']));

            // Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            // Server settings                    
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $website->email; // SMTP username
            $mail->Password = $website->smtp_password; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = "UTF-8";
            // Recipients
            $mail->setFrom($email,$website->siteWeb);
            $mail->addAddress($website->email); // Add a recipient

            // Attachments
            /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */// Optional name
            // Content

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "$website->siteWeb - Message de contact de l'utilisateur";
            $mail->Body = "
                <p><b>Message de contact $website->siteWeb</b></p>
                <p> Cher/Chère l'administrateur de $website->siteWeb</p>
                <p>$message<br/>

                <p>Voici mes coordonnées pour que vous puissiez me contacter :</p><br/><br/>
                nom complet : $first_name $last_name<br/>
                Email :  $email <br/></br>
                <p>Je vous remercie de votre attention et j'attends votre réponse avec impatience.</p>
                <br/>
                <p>Cordialement,</p>
                <p>$first_name $last_name</P>
               ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->send()) {
                echo 'Message email contact has been sent';
            } else {
                echo "Le message email contact n'a pas pu être envoye";
            }
        
    
}


// Complete registration
if (isset($_POST['register'])) {
    $firstNameArabe = htmlspecialchars(trim($_POST['firstNameArabe']));
    $lastNameArabe = htmlspecialchars(trim($_POST['lastNameArabe']));
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $cin = htmlspecialchars(trim($_POST['cin']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $dateBirth = htmlspecialchars(trim($_POST['birthDate']));
    $placeBirth = htmlspecialchars(trim($_POST['birthPlace']));
    $codeMassar = htmlspecialchars(trim($_POST['codeMassar']));
    $sector = htmlspecialchars(trim($_POST['sector']));
    $bacYear = htmlspecialchars(trim($_POST['bacYear']));
    $region = htmlspecialchars(trim($_POST['region']));
    $city = htmlspecialchars(trim($_POST['city']));
    $school = htmlspecialchars(trim($_POST['school']));
    $address = htmlspecialchars(trim($_POST['adress']));
    $zipCode = htmlspecialchars(trim($_POST['zipCode']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));
    $parentPhone = htmlspecialchars(trim($_POST['parentPhone']));


    $file_name = $_FILES["image"]["name"];
    //$file_size = $_FILES["image"]["size"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    //$file_type = $_FILES["image"]["type"];
    //$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validate file type and size
    /* $allowed_exts = array("jpg", "jpeg", "png", "gif");
    $max_size = 1048576; // 1 MB
    if (!in_array($file_ext, $allowed_exts)) {
        echo "Invalid file type.";
        exit;
    } elseif ($file_size > $max_size) {
        echo "File size exceeds 1 MB.";
        exit;
    } */

    // Create image resource from file
    /* if ($file_ext == "jpg" || $file_ext == "jpeg") {
        $img = imagecreatefromjpeg($file_tmp);
    } elseif ($file_ext == "png") {
        $img = imagecreatefrompng($file_tmp);
    } elseif ($file_ext == "gif") {
        $img = imagecreatefromgif($file_tmp);
    } elseif ($file_ext == "webp") {
        $img = imagecreatefromwebp($file_tmp);
    }else {
        echo 'Invalid file type';
        exit;
    } */

    // Convert image to JPEG format if it is not already in JPEG format
    /* if ($file_ext != "jpg" && $file_ext != "jpeg") {
        $file_path = '';
        $new_file_path = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_path) . ".jpg";
        imagejpeg($img, $new_file_path, 80);
        $file_ext = "jpg";
    } */
    
    $file_new_name = uniqid().$file_name;
    $image_path =  "profile_images/" . $file_new_name;
    if(move_uploaded_file($file_tmp,"../profile_images/".$file_new_name)){        
        $stmt = $db->prepare("UPDATE students SET codeMassar=?, cin=?, firstName=?, lastName=?, firstNameArabe=?, lastNameArabe=?, sex=?, photo=?, bacYear=?,dateBirth=?, placeBirth=?, phone=?, parentPhone=?, address=?, idBac=?,idLycee=?, idRegion=?, idCity=?,statut=2 WHERE email=?");


        $data = array($codeMassar, $cin, $firstName, $lastName, $firstNameArabe, $lastNameArabe, $sex, $image_path, $bacYear, $dateBirth, $placeBirth, $phoneNumber, $parentPhone, $address, $sector,$school, $region, $city, $email);
        $count = $db->execute($stmt, $data);

        if($count > 0){
            echo "Added";
        } else {
            echo "Error";
        }
    }else{
        echo "Error";
    }  
   

}

// answer of signup form
if (isset($_POST['login'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $res = $db->selectDb("SELECT email,password,id_student,firstName,lastName,photo, idBac,codeMassar,statut from students where email='$email' and password='$password'");
        $khalid = $db->selectDb("SELECT * from students where email='$email' and password='$password'");
        $count = $res->rowCount();        
        if ($count == 1) {
            $data = $res->fetch();
            if($data[8] == 2){                
                $_SESSION['studentInfo'] = $khalid->fetch(PDO::FETCH_ASSOC) ;
                $_SESSION['email_student'] = $email;
                $_SESSION['password_student'] = $password;
                $_SESSION['unique_id_student'] = $data[2];
                $_SESSION['firstName_student'] = $data[3];
                $_SESSION['lastName_student'] = $data[4];
                $_SESSION['photo_student'] = $data[5];
                $_SESSION['idBac'] = $data[6];
                $_SESSION['codeMassar'] = $data[7];
                echo 'informations correctes';
            }else{
                echo 'nonActive';
            }       
        } else {
            echo 'informations incorrect';
        }
    }
}

// select region from database

if (isset($_GET['region'])) {
    
    $res = $db->selectDb("SELECT * from region");
    while ($row = $res->fetch()) {
        echo "<option dir='ltr' value=$row[0]>$row[1]</option>";
    }
}

// select sector from database

if (isset($_GET['sector'])) {
    
    $res = $db->selectDb("SELECT * from bac");
    while ($row = $res->fetch()) {
        echo "<option value=$row[0]>$row[1]</option>";
    }
}

// select city from database

if (isset($_GET['city'])) {
    $idregion = $_GET['idregion'];
    
    $res = $db->selectDb("SELECT * from city where idRegion=$idregion");
    while ($row = $res->fetch()) {
        echo "<option dir='ltr' value=$row[0] class='city_option'>$row[1]</option>";
    }
}


// select lycee from database

if(isset($_GET['school'])){
//$idcity = $_GET['idcity'];

$res = $db->selectDb("SELECT * from lycee");
while($row = $res->fetch()){
 echo "<option value=$row[0] class='city_option'>$row[1]</option>";
}
}

// fetch data profile
if(isset($_POST['profile'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $res = $c->dataProfile($email,$password);

}

// forget password 
    // send confirmation code
if(isset($_GET['email_forget'])){
    $website = $db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);
    $email = htmlspecialchars(trim($_GET['email_forget']));
    $res = $db->selectDb("SELECT * FROM students WHERE email='$email'");
    $row = $res->rowCount();
    if($row == 1){
        $code = substr((string) (time() * 1000000 + mt_rand(0, 999999)), -6);
        
        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        // Server settings                    
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $website->email; // SMTP username
        $mail->Password = $website->smtp_password; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = "UTF-8";
        // Recipients
        $mail->setFrom($website->email,$website->siteWeb);
        $mail->addAddress($email); // Add a recipient


        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'إعادة تعيين كلمة المرور, compte Tawjih';
        /* $mail->Body = "
            <p><b>إعادة تعيين كلمة المرور</b></p>
            <p> مرحبا ، رمز التأكيد الخاص بك :<br/> $code </p>
            شكرًا !"; */
        // ---------- body html ---------------------------------------------------------------------------------------------------------------------------
        $mail->Body = "
        <html>
        <head>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css'
                integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'>
        </head>

        <body>
            <table class='body-wrap'
                style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;''
                bgcolor='#f6f6f6'>
                <tbody>
                    <tr
                        style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;'>
                        <td style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;'
                            valign='top'></td>
                        <td class='container' width='600'
                            style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;'
                            valign='top'>
                            <div class='content'
                                style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;'>
                                <table class='main' width='100%' cellpadding='0' cellspacing='0' itemprop='action' itemscope=''
                                    itemtype='http://schema.org/ConfirmAction'
                                    style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;'>
                                    <tbody>
                                        <tr
                                            style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;'>
                                            <td class='content-wrap'
                                                style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;padding: 30px;border: 3px solid #67a8e4;border-radius: 7px; background-color: #fff;'
                                                valign='top'>
                                                <meta itemprop='name' content='Confirm Email'
                                                    style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;'>
                                                <table width='100%' cellpadding='0' cellspacing='0'
                                                    style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;'>
                                                    <tbody>
                                                        <tr
                                                            style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;'>
                                                            <td class='content-block'
                                                                style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;'
                                                                valign='top'>
                                                                <div style='text-align: center;'>إعادة تعيين كلمة المرور</div>
                                                                <br>
                                                                Réinitialisation du mot de passe de votre compte dans site
                                                                web tawjih
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;'>
                                                            <td class='content-block'
                                                                style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;'
                                                                valign='top'>
                                                                pour changer le mot de passe de votre compte. veuillez
                                                                copier le code ci-dessous pour réinitialiser votre mot de
                                                                passe.
                                                            </td>
                                                        </tr>
                                                        <tr
                                                            style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;'>
                                                            <td class='content-block'
                                                                itemtype='http://schema.org/HttpActionHandler'
                                                                style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;'
                                                                valign='top'>
                                                                <div
                                                                    style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 20px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #f06292; margin: 0; border-color: #f06292; border-style: solid; border-width: 8px 16px;letter-spacing: 3px;'>
                                                                    $code</div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        </html>";
        // ------------------------------------------------------------------------------------------------------------------------------------------------
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            $_SESSION['code'] = $code;
            $_SESSION['email_to_change'] = $email;
            echo 'Message sent';
        } else {
            echo "Le messag pas envoyé";
        }
    }else{
        echo 'this email not found'; 
    }
}

// change password student whine forget old password
if(isset($_POST['new_password']) && isset($_POST['email_to_change'])){
    $new_password = htmlspecialchars($_POST['new_password']);
    $email_to_change = htmlspecialchars($_POST['email_to_change']);

    $res = $db->updateDb("UPDATE students SET password = '$new_password' WHERE email='$email_to_change'");
    if($res == 1){
        echo 'password is change';
        unset($_SESSION['code']);
        unset($_SESSION['email_to_change']);
    }else{
        echo 'password is not change';
    }
}

// check confirmation code
if(isset($_POST['code'])){
    $code_enter =htmlspecialchars(trim($_POST['code']));
    $code_send = $_SESSION['code'];
    if ($code_enter == $code_send) {
        echo "good";
    } else {
        echo "not good";
    }
}

// changer password inside of account student
if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['email_student']) && isset($_POST['id_student'])){       
    $old_password = htmlspecialchars($_POST['old_password']);
    $new_password = htmlspecialchars($_POST['new_password']);   
    $email_student = htmlspecialchars($_POST['email_student']);   
    $id_student = htmlspecialchars($_POST['id_student']); 
    
    $chekcPassword = $db->selectDb("SELECT password FROM students WHERE email='$email_student' AND id_student = '$id_student' AND password = '$old_password'");
    if($chekcPassword){
        if($chekcPassword->rowCount() == 1){           
            $res = $db->updateDb("UPDATE students SET password = '$new_password' 
                                WHERE email='$email_student' AND id_student = '$id_student' AND password = '$old_password'");
            if($res == 1){
                echo 'password is change';        
            }else{
                echo 'password is not change';
            }
        }else{
            echo "old password incorrect";
        }               
    }else{
        echo "error";
    }    
}
