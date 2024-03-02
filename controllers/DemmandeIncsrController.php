<?php 
session_start();
include "../models/db.php";
include "../boostrap.php";

// include PPHMailer
require './includes/Exception.php';
require './includes/PHPMailer.php';
require './includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
////////////////////////////////////////////////////////

class DemmandeIncsrController {

   public $db;
   public function __construct() {
      $this -> db  = new Db();
   }
   // send email in firset request of inscription
   public function sendEmail($email,$nom,$prenom){
       // get email dynamic form database
       $website = $this->db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);
      // Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);
      try{
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
         $mail->setFrom($website->email, $website->siteWeb);
         $mail->addAddress($email); // Add a recipient


         $mail->isHTML(true); // Set email format to HTML
         $mail->Subject = "Demmande d'inscription Tawjih";
         // ---------- body html ---------------------------------------------------------------------------------------------------------------------------
         $mail->Body = "<html>

         <head>
            <title></title>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge' />
            <style type='text/css'>
               @media screen {
                     @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
                     }
         
                     @font-face {
                        font-family: 'Lato';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
                     }
         
                     @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 400;
                        src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
                     }
         
                     @font-face {
                        font-family: 'Lato';
                        font-style: italic;
                        font-weight: 700;
                        src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
                     }
               }
         
               /* CLIENT-SPECIFIC STYLES */
               body{padding-left: 8px;padding-right: 8px;}
               body,
               table,
               td,
               a {
                     -webkit-text-size-adjust: 100%;
                     -ms-text-size-adjust: 100%;
               }
         
               table,
               td {
                     mso-table-lspace: 0pt;
                     mso-table-rspace: 0pt;
               }
         
               img {
                     -ms-interpolation-mode: bicubic;
               }
         
               /* RESET STYLES */
               img {
                     border: 0;
                     height: auto;
                     line-height: 100%;
                     outline: none;
                     text-decoration: none;
               }
         
               table {
                     border-collapse: collapse !important;
               }
         
               body {
                     height: 100% !important;
                     margin: 0 !important;
                     padding: 0 !important;
                     width: 100% !important;
               }
         
               /* iOS BLUE LINKS */
               a[x-apple-data-detectors] {
                     color: inherit !important;
                     text-decoration: none !important;
                     font-size: inherit !important;
                     font-family: inherit !important;
                     font-weight: inherit !important;
                     line-height: inherit !important;
               }
         
               /* MOBILE STYLES */
               @media screen and (max-width:600px) {
                     h1 {
                        font-size: 32px !important;
                        line-height: 32px !important;
                     }
               }
         
               /* ANDROID CENTER FIX */
               div[style*='margin: 16px 0;'] {
                     margin: 0 !important;
               }
            </style>
         </head>
         
         <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
            <!-- HIDDEN PREHEADER TEXT -->
            <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'> We're thrilled to have you here! Get ready to dive into your new account.
            </div>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
               <!-- LOGO -->
               <tr>
                     <td bgcolor='#20c997' align='center'>
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                           <tr>
                                 <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                           </tr>
                        </table>
                     </td>
               </tr>
               <tr>
                     <td bgcolor='#20c997' align='center' style='padding: 0px 10px 0px 10px;'>
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                           <tr>
                                 <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                    <h1 style='font-size: 48px; font-weight: 400; margin: 2;'>Bienvenu!</h1> <img src=' https://img.icons8.com/clouds/100/000000/handshake.png' width='125' height='120' style='display: block; border: 0px;' />
                                 </td>
                           </tr>
                        </table>
                     </td>
               </tr>
               <tr>
                     <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                           <tr>
                                 <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                    <p style='margin: 0;'>Cher $nom $prenom,<br><br>
                                       Merci de votre intérêt à participer sur notre plateforme. Nous avons reçu votre demande et souhaitons vous informer que l'équipe de notre plateforme l'examine actuellement. Nous vous remercions de votre patience et nous vous répondrons dans les plus brefs délais.
                                    </p><br/>  
                                 </td>
                           </tr>                           
                           <tr>
                                 <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                    <p style='margin: 0;'>Si vous avez des questions, répondez simplement à cet e-mail&mdash; Nous serons toujours ravis de vous aider.</p><br/>
                                 </td>
                           </tr>
                           <tr>
                                 <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                    <p style='margin: 0;'> Cordialement,<br>Tawjih Équipe</p>
                                 </td>
                           </tr>
                        </table>
                     </td>
               </tr>
               <tr>
                     <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                           <tr>
                                 <td bgcolor='#FFECD1' align='center' style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                                    <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Besoin d'aide?</h2>
                                    <p style='margin: 0;'><a href='".BASE_URL."/#section_tele' target='_blank' style='color: #20c997;'>Nous sommes là pour vous aider</a></p>
                                 </td>
                           </tr>
                        </table>
                     </td>
               </tr>        
            </table>
         </body>
         
         </html>";
         // ------------------------------------------------------------------------------------------------------------------------------------------------
         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
         
         if($mail->send()){
            return true;
         }else{
            return false;
         }
      } catch (Exception $e) {
         //echo "Failed to send email. Error: " . $mail->ErrorInfo;
         return false;
      }
   }

   //send email whine admin accept request for complite inscription
   public function sendEmailAccepteDemmande($email,$defaultPassword,$token,$expiry_date,$nomComlet){                                      
      $res = $this->db->selectDb("SELECT * from students where email='$email'");
      $count = $res->rowCount();
      if ($count != 0) {
         echo 'Cet email existe déjà!';
      } else {
          // get email dynamic form database
         $website = $this->db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);

         // Create an instance; passing `true` enables exceptions
         $mail = new PHPMailer(true);
         try{
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

         // Attachments
         /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
         $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */// Optional name
         // Content        
         $link = BASE_URL."/?page="."complete-profile&email=" . urlencode($email) . "&token=" . $token;


         $mail->isHTML(true); // Set email format to HTML
         $mail->Subject = 'Création de compte';
         $mail->Body = "<html>
         <head>
           <title></title>
           <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
           <meta name='viewport' content='width=device-width, initial-scale=1'>
           <meta http-equiv='X-UA-Compatible' content='IE=edge' />
           <style type='text/css'>
             @media screen {
               @font-face {
                 font-family: 'Lato';
                 font-style: normal;
                 font-weight: 400;
                 src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
               }
         
               @font-face {
                 font-family: 'Lato';
                 font-style: normal;
                 font-weight: 700;
                 src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
               }
         
               @font-face {
                 font-family: 'Lato';
                 font-style: italic;
                 font-weight: 400;
                 src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
               }
         
               @font-face {
                 font-family: 'Lato';
                 font-style: italic;
                 font-weight: 700;
                 src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
               }
             }
         
             /* CLIENT-SPECIFIC STYLES */
             body,
             table,
             td,
             a {
               -webkit-text-size-adjust: 100%;
               -ms-text-size-adjust: 100%;
             }
         
             table,
             td {
               mso-table-lspace: 0pt;
               mso-table-rspace: 0pt;
             }
         
             img {
               -ms-interpolation-mode: bicubic;
             }
         
             /* RESET STYLES */
             img {
               border: 0;
               height: auto;
               line-height: 100%;
               outline: none;
               text-decoration: none;
             }
         
             table {
               border-collapse: collapse !important;
             }
         
             body {
               height: 100% !important;
               margin: 0 !important;
               padding-top: 0 !important;
               padding-bottom: 0 !important;
               padding-left: 8 !important;
               padding-bottom: 8 !important;
               width: 100% !important;
             }
         
             /* iOS BLUE LINKS */
             a[x-apple-data-detectors] {
               color: inherit !important;
               text-decoration: none !important;
               font-size: inherit !important;
               font-family: inherit !important;
               font-weight: inherit !important;
               line-height: inherit !important;
             }
         
             /* MOBILE STYLES */
             @media screen and (max-width:600px) {
               h1 {
                 font-size: 32px !important;
                 line-height: 32px !important;
               }
             }
         
             /* ANDROID CENTER FIX */
             div[style*='margin: 16px 0;'] {
               margin: 0 !important;
             }
           </style>
         </head>
         
         <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
           <!-- HIDDEN PREHEADER TEXT -->
           <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: ' Lato', Helvetica, Arial,
             sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'> We're thrilled to have you here! Get
             ready to dive into your new account.
           </div>
           <table border='0' cellpadding='0' cellspacing='0' width='100%'>
             <!-- LOGO -->
             <tr>
               <td bgcolor='#20c997' align='center'>
                 <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                   <tr>
                     <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                   </tr>
                 </table>
               </td>
             </tr>
             <tr>
               <td bgcolor='#20c997' align='center' style='padding: 0px 10px 0px 10px;'>
                 <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                   <tr>
                     <td bgcolor='#ffffff' align='center' valign='top'
                       style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: ' Lato',
                       Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                       <h1 style='font-size: 48px; font-weight: 400; margin: 2;'>Félicitation! <br> votre demande acceptée</h1> <img
                         src=' https://img.icons8.com/clouds/100/000000/handshake.png' width='125' height='120'
                         style='display: block; border: 0px;' />
                     </td>
                   </tr>
                 </table>
               </td>
             </tr>
             <tr>
               <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
                 <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                   <tr>
                     <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: '
                       Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                       <p style='margin: 0;'>Cher $nomComlet,<br><br>                
         
                         Votre compte a été créé avec succès ! <br><br>
         
                         Information de connexion : <br>
                         Email : $email <br>
                         Mot de passe : $defaultPassword <br><br>
         
                         Pour compléter et activer votre compte, veuillez cliquer sur le lien suivant : <br><br>
         
                         <a href='".$link."'> Activation et connexion</a> 
                         <p> Votre lien d'activation expirera le $expiry_date </p><br><br>
         
                         Si le lien ne marche pas, veuillez, copier ce lien ci-dessous : <br>
                         $link 
                       </p><br />
                     </td>
                   </tr>
                   <tr>
                     <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: ' Lato',
                       Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                       <p style='margin: 0;'>Si vous avez des questions, répondez simplement à cet e-mail&mdash; Nous serons
                         toujours ravis de vous aider.</p><br />
                     </td>
                   </tr>
                   <tr>
                     <td bgcolor='#ffffff' align='left'
                       style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: ' Lato',
                       Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                       <p style='margin: 0;'> Cordialement,<br>Tawjih Équipe</p>
                     </td>
                   </tr>
                 </table>
               </td>
             </tr>
             <tr>
               <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
                 <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                   <tr>
                     <td bgcolor='#FFECD1' align='center'
                       style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: ' Lato',
                       Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                       <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Besoin d'aide?</h2>
                       <p style='margin: 0;'><a href='".BASE_URL."/#section_tele' target='_blank' style='color: #20c997;'>Nous
                           sommes là pour vous aider</a></p>
                     </td>
                   </tr>
                 </table>
               </td>
             </tr>
           </table>
         </body>
         </html>";
         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

         if ($mail->send()) {
            return true;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $defaultPassword;              
         } else {
            return false;
         }
         } catch (Exception $e) {
            //echo "Failed to send email. Error: " . $mail->ErrorInfo;
            return false;
         }
      }
   }

   //send email whine admin accept request for complite inscription
   public function sendEmailRefuseDemmande($email,$nomComlet){ 
      // get email dynamic form database
      $website = $this->db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);
      // Create an instance; passing `true` enables exceptions
      $mail = new PHPMailer(true);
      try{
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

      // Attachments
      /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  */// Optional name
      // Content
      
      $mail->isHTML(true); // Set email format to HTML
      $mail->Subject = 'Création de compte';
      $mail->Body = "<html>
      <head>
         <title></title>
         <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
         <meta name='viewport' content='width=device-width, initial-scale=1'>
         <meta http-equiv='X-UA-Compatible' content='IE=edge' />
         <style type='text/css'>
            @media screen {
            @font-face {
               font-family: 'Lato';
               font-style: normal;
               font-weight: 400;
               src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }
      
            @font-face {
               font-family: 'Lato';
               font-style: normal;
               font-weight: 700;
               src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }
      
            @font-face {
               font-family: 'Lato';
               font-style: italic;
               font-weight: 400;
               src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }
      
            @font-face {
               font-family: 'Lato';
               font-style: italic;
               font-weight: 700;
               src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
            }
      
            /* CLIENT-SPECIFIC STYLES */
            body,
            table,
            td,
            a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            }
      
            table,
            td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            }
      
            img {
            -ms-interpolation-mode: bicubic;
            }
      
            /* RESET STYLES */
            img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            }
      
            table {
            border-collapse: collapse !important;
            }
      
            body {
            height: 100% !important;
            margin: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            padding-left: 8 !important;
            padding-bottom: 8 !important;
            width: 100% !important;
            }
      
            /* iOS BLUE LINKS */
            a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            }
      
            /* MOBILE STYLES */
            @media screen and (max-width:600px) {
            h1 {
               font-size: 32px !important;
               line-height: 32px !important;
            }
            }
      
            /* ANDROID CENTER FIX */
            div[style*='margin: 16px 0;'] {
            margin: 0 !important;
            }
         </style>
      </head>
      
      <body style='background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;'>
         <!-- HIDDEN PREHEADER TEXT -->
         <div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: ' Lato', Helvetica, Arial,
            sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'> We're thrilled to have you here! Get
            ready to dive into your new account.
         </div>
         <table border='0' cellpadding='0' cellspacing='0' width='100%'>
            <!-- LOGO -->
            <tr>
            <td bgcolor='#20c997' align='center'>
               <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                  <tr>
                  <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                  </tr>
               </table>
            </td>
            </tr>
            <tr>
            <td bgcolor='#20c997' align='center' style='padding: 0px 10px 0px 10px;'>
               <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                  <tr>
                  <td bgcolor='#ffffff' align='center' valign='top'
                     style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: ' Lato',
                     Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                     <h1 style='font-size: 48px; font-weight: 400; margin: 2;'>AljisrTawjih! <br> votre demande refusée </h1> <img
                        src=' https://img.icons8.com/clouds/100/000000/handshake.png' width='125' height='120'
                        style='display: block; border: 0px;' />
                  </td>
                  </tr>
               </table>
            </td>
            </tr>
            <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding: 0px 10px 0px 10px;'>
               <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                  <tr>
                  <td bgcolor='#ffffff' align='left' style='padding: 20px 30px 40px 30px; color: #666666; font-family: '
                     Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                     <p style='margin: 0;'>Cher $nomComlet,<br><br>                
                     Votre demande d'ouverture de compte a été refusée. <br/>
                     Veuillez contacter notre équipe d'assistance pour obtenir de l'aide <br><br>
                     <a href='".BASE_URL."/#section_tele' target='_blank'>cliquez ici pour nous contact</a>
                     </p><br />
                  </td>
                  </tr>
                  <tr>
                  <td bgcolor='#ffffff' align='left' style='padding: 0px 30px 20px 30px; color: #666666; font-family: ' Lato',
                     Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                     <p style='margin: 0;'>Si vous avez des questions, répondez simplement à cet e-mail&mdash; Nous serons
                        toujours ravis de vous aider.</p><br />
                  </td>
                  </tr>
                  <tr>
                  <td bgcolor='#ffffff' align='left'
                     style='padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: ' Lato',
                     Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                     <p style='margin: 0;'> Cordialement,<br>Tawjih Équipe</p>
                  </td>
                  </tr>
               </table>
            </td>
            </tr>
            <tr>
            <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 0px 10px;'>
               <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                  <tr>
                  <td bgcolor='#FFECD1' align='center'
                     style='padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: ' Lato',
                     Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;'>
                     <h2 style='font-size: 20px; font-weight: 400; color: #111111; margin: 0;'>Besoin d'aide?</h2>
                     <p style='margin: 0;'><a href='".BASE_URL."/#section_tele' target='_blank' style='color: #20c997;'>Nous
                        sommes là pour vous aider</a></p>
                  </td>
                  </tr>
               </table>
            </td>
            </tr>
         </table>
      </body>
      </html>";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      if ($mail->send()) {
         return true;                       
      } else {
         return false;
      }
      } catch (Exception $e) {
         //echo "Failed to send email. Error: " . $mail->ErrorInfo;
         return false;
      }      
   }

   public function generateDefaultPassword() {
      // Define a pool of characters to generate the password from
      $lowercharacters = 'abcdefghijklmnopqrstuvwxyz';
      $upercharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $number = '0123456789';

      // Get the length of the character pool
      $poolLengthLower = strlen($lowercharacters);
      $poolLengthLowerUper = strlen($upercharacters);
      $poolLengthNumber = strlen($number);

      // Initialize an empty password string
      $password = '';

      // Generate random characters from the pool to create the password
      for ($i = 0; $i < 1; $i++) {
         $password .= $upercharacters[random_int(0, $poolLengthLowerUper - 1)];
      }
      for ($i = 0; $i < 4; $i++) {
         $password .= $lowercharacters[random_int(0, $poolLengthLower - 1)];
      }
      for ($i = 0; $i < 4; $i++) {
         $password .= $number[random_int(0, $poolLengthNumber - 1)];
      }

      return $password;
   }
  
  
   //---------- FIRST STEP --------------------
   public function RegistrationRequest($data) {

      $nomSTD = htmlspecialchars($data['nomStd']);
      $prenomSTD = htmlspecialchars($data['prenomStd']);
      $teleSTD = htmlspecialchars($data['phoneStd']);
      $emailSTD = htmlspecialchars($data['emailStd']);
      $methodePayment = $data['methodePayment'];
      $idPack = $data['id_pack'];

      $selectStd = $this -> db->selectDb("SELECT * FROM demande_inscription  WHERE email = '$emailSTD'");

      if ($selectStd -> rowCount() > 0) {
         echo json_encode([
            'resultat' => 'this_email_existe'
         ]);

      } else {
         // sende email
         if($this->sendEmail($emailSTD,$nomSTD,$prenomSTD)){
            $sql = "INSERT INTO demande_inscription(nom,prenom,tele,email,methodePayment,idPack)
            VALUES(?,?,?,?,?,?)";
            $stm = $this -> db ->prepare($sql);
            $res = $stm -> execute([$nomSTD,$prenomSTD,$teleSTD,$emailSTD,$methodePayment,$idPack]);

            if ($res) {
               //------------- Envoyer Email -------------------            
               //----------------------------------------------
               echo json_encode([
                  'resultat' => 'ok_add_demamdeInscription'
               ]);
            } else {
               echo json_encode([
                  'resultat' => 'no_add_demamdeInscription'
               ]);
            }
         }else{
            echo json_encode([
               'resultat' => 'email_error'
            ]);
         }
      }

   }

   // GET ALL RESPONSABLES
   public function getAllResponsables($status,$rowId,$idResponsable) {
      $sql = "SELECT *   FROM responsables";

      $res = $this -> db -> selectDb($sql);

      $output = "<select id='selectResOption_".$rowId."' 
         class='form-control ".($status == 2 &&  $idResponsable == null  ? 'border-danger':'border-primary')."' 
         ".($status != 2 ? 'disabled':'')." 
         onchange='setResponsableToStd(event,".$rowId.")'>
         <option value='' disabled selected>Choisissez Responsable</option>
         <option value='-1' ".(($idResponsable == -1 ? 'selected':'')).">aucun responsable</option>
         ";

      if ($res -> rowCount() > 0) {

         while ($row = $res -> fetch(PDO::FETCH_OBJ)) {
            $output .= "
               <option ".($idResponsable == $row->idRes ? 'selected':'')." value='".$row->idRes."'>".$row->nomRes.' '. $row->prenomRes.  "</option>

            ";
         }

      } 
      else {
         $output .="
         <option value='' selected hidden>Il n'y a aucun responsables</option>
         ";
      }

      $output .= "</select>";

      return  $output;

   }

   public function getAllDemandes() {

      $sql = "SELECT demande_inscription.* , packs.domaineAbreviationP , packs.prixPack   FROM demande_inscription , packs
            WHERE demande_inscription.idPack = packs.idPack ORDER BY demande_inscription.ID DESC";
      $res = $this -> db -> selectDb($sql);


      $output = '';
      if ($res -> rowCount() > 0) {

         while ($row = $res -> fetch(PDO::FETCH_OBJ)) {
            $selectOptionResponsable = $this -> getAllResponsables($row->status,$row->id,$row->idResponsable);

            $output .= "
            
            <tr>            
            <td>".$row->nom."</td>
            <td>".$row->tele."</td>
            <td>".$row->email."</td>
            <td>".($row->methodePayment == 0 ? 'Espèce':'carte bancaire')."</td>
            <td>".date('d/m/Y',strtotime($row->created_at))."</td>
            <td>".$row->domaineAbreviationP."</td>
            <td>".$row -> prixPack." DH</td>
            <td>
               <div class='select-wrapper'>
                  <select class='form-control border-primary' onchange='changeStatut(event,".$row->id.")'>                     
                     <option value='0' ".($row->status == 0 ? 'selected':'').">En attente</option>
                     <option value='1' ".($row->status == 1 ? 'selected':'').">Refuser</option>
                     <option value='2' ".($row->status == 2 ? 'selected':'').">Accepter</option>
                  </select>
                  <div class='select-arrow'></div>
               </div>
            </td>
            <td>
               ".  $selectOptionResponsable."
            </td>
            <td>
            <button class='text-light btn' onclick='deleteDemande(".$row->id.")'>" . "<i class='fa-solid fa-trash-can' style='color: #d80e0e;font-size: 20px;'></i>" . "</button></td>
            </td>
         </tr>
            ";
         }
         
      } else {
         $output .='
            <tr style="height: 5opx;">
               <td class="text-center" colspan="12">Aucune demande d\'inscription</td>
            </tr>
         ';
      }
      echo json_encode([
         'resultat' => $output
      ]);
   }

   // change Status Demande
   public function changeStatusDemande($idDemande , $statutValue) {
      // Get demande from table demande_inscription
      $demande_inscription = $this -> db -> selectDb("SELECT * FROM demande_inscription  WHERE id = $idDemande")->fetch(PDO::FETCH_OBJ);

      // Controle status 0 || 1 || 2
      if ($statutValue == 2) { //Status 0  Accepter
         // Envoyer Email pour Completer L'inscription

         // Generate a default password of length 8
         $defaultPassword = $this->generateDefaultPassword();
         $id_student = rand(time(),1000000);
         // Generate token and expiration date
         $token = bin2hex(random_bytes(16));
         $expiry_date = date('Y-m-d H:i:s', strtotime('+1 day')); 
         $nomComlet = $demande_inscription->nom ." ".$demande_inscription->prenom;
         // check if email send or no/  !! if not send can't insert student in database
         if( $this->sendEmailAccepteDemmande($demande_inscription->email,$defaultPassword,$token,$expiry_date,$nomComlet)){
            $sqlAdd = "INSERT INTO students(codeMassar,email,id_pack,id_student,password,token, token_expiry_date) VALUES($demande_inscription->id,'$demande_inscription->email',$demande_inscription->idPack,'$id_student','$defaultPassword','$token','$expiry_date')";
            $resAdd  = $this ->db->updateDb($sqlAdd);
            if ($resAdd > 0) {
               // *****************************
               // Etudaiante Ajouter               
               // *****************************


               $this -> db -> updateDb("UPDATE demande_inscription SET status = 2 WHERE  id = $idDemande");
               
               echo json_encode([
                  'resultat' => 'etudiante_ajouter'
                  ]);

            } else {
               echo json_encode([
                  'resultat' => 'etudiante_non_ajouter'
                  ]);
            }
         }else{
            echo json_encode([
               'resultat' => 'error_email_not_send'
               ]);
         }

      } else if ($statutValue == 1) { //Status 0 Refuser
            // *****************************
            // Etudaiante Refuser
            // Envoyer Email  en case de refuser
            // *****************************
            $nomComlet = $demande_inscription->nom ." ".$demande_inscription->prenom;
            if($this->sendEmailRefuseDemmande($demande_inscription->email,$nomComlet)){
               $this -> db -> updateDb("UPDATE demande_inscription 
                        SET status = 1  , idResponsable = null
                        WHERE  id = $idDemande");
               $this -> db ->updateDb("DELETE FROM  students WHERE  email = '$demande_inscription->email'");
               echo json_encode([
                  'resultat' => 'success_refuser'
               ]);
            }else{
               echo json_encode([
                  'resultat' => 'error_email_not_send'
               ]);
            }
         
      } else { //Status 0 En attende

         $this -> db -> updateDb("UPDATE demande_inscription 
         SET status = 0 , idResponsable = null
         WHERE  id = $idDemande");
         $this -> db ->updateDb("DELETE FROM  students WHERE  email = '$demande_inscription->email'");
         echo json_encode([
            'resultat' => 'success_enAttende'
            ]);
      }


   }
   //---------------------
   //choose Responsable To Std
   //------------------
   public function chooseResponsableToStd($data) {
      $idResponsable = $data['idResponsable'];
      $idDemande = $data['idDemande'];

      $this -> db -> updateDb("UPDATE demande_inscription SET  idResponsable = $idResponsable WHERE id = $idDemande");

      $demandesStd = $this -> db -> selectDb("SELECT * FROM demande_inscription WHERE id = $idDemande")->fetch(PDO::FETCH_OBJ);

      $affectResToStd = $this -> db->updateDb("UPDATE students SET id_responsable = $idResponsable WHERE email = '$demandesStd->email'");

      if ($affectResToStd > 0) {

         echo json_encode([
            'resultat' => 'success_affected_responsable'
         ]) ;

      } else {

         echo json_encode([
            'resultat' => 'not_affected_responsable'
         ]) ;

      }

   }

   public function delteDemande($id){
      $deleteResulta = $this -> db -> updateDb("DELETE FROM demande_inscription WHERE id=$id");
      if($deleteResulta > 0){
         echo json_encode([
            "resultat"=>"demande_deleted"
         ]);
      }else{
         echo json_encode([
            "resultat"=>"error"
         ]);
      }
   }
}

$demandeInsc = new DemmandeIncsrController();

if (isset($_POST['demandeInscription'])) {
   $demandeInsc -> RegistrationRequest($_POST);
}

if (isset($_GET['getAllDemandes'])) {
   $demandeInsc -> getAllDemandes();
}

// change Status Demande
if (isset($_GET['changeStatusDemande'])) {
   $idDemande = $_GET['idDemande'];
   $statutValue = $_GET['statutValue'];

   $demandeInsc -> changeStatusDemande($idDemande,$statutValue);
}

if (isset($_GET['chooseResponsable'])) {
   $demandeInsc -> chooseResponsableToStd($_GET);
}

if (isset($_GET['delteDemande'])) {
   $id = $_GET['idDemande'];
   $demandeInsc -> delteDemande($id);
}
