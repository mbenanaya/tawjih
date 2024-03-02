<?php
include "../../models/db.php";
class WebSiteController{
   public $db;
   private $DB_NAME;
   public function __construct(){
      $this -> db = new Db();
   }

   private function uploadImage(){
      $logo_name = $_FILES['logo']['name'];
      $logo_type = $_FILES['logo']['type'];
      $logo_tmp = $_FILES['logo']['tmp_name'];

      $explode_logo = explode('.',$logo_name);
      $extension_logo = end($explode_logo);
      $extensions = ['png', 'jpeg', 'jpg'];

      if(in_array($extension_logo,$extensions) == true){
         $time = time();
         $new_logo_name = $time.$logo_name;

        if(move_uploaded_file($logo_tmp,'../../views/assets/images/logos/'.$new_logo_name)){
          return $new_logo_name;
        };

      }else{
         echo json_encode([
            'message' => 'error_logo',
         ]);
      }

   }
   public function store($data){
      $siteWeb = htmlspecialchars(trim($data['siteWeb']));
      $email = htmlspecialchars(trim($data['email']));
      $tele = htmlspecialchars(trim($_POST['tele']));
      $address = htmlspecialchars(trim($data['address']));
      // $codePostal = htmlspecialchars(trim($data['codePostal']));
      // $ville = htmlspecialchars(trim($data['ville']));
      $twitter = htmlspecialchars(trim($data['twitter']));
      $facebook = htmlspecialchars(trim($data['facebook']));
      $youtube = htmlspecialchars(trim($data['youtube']));
      $instagrame = htmlspecialchars(trim($data['instagrame']));
      $quiSommesNous = htmlspecialchars(trim($data['quiSommesNous']));
      $aproposDuSite = htmlspecialchars(trim($data['aproposDuSite']));

      if(isset($_FILES['logo'])){
         $logo_name = $_FILES['logo']['name'];
         $logo_type = $_FILES['logo']['type'];
         $logo_tmp = $_FILES['logo']['tmp_name'];

         $explode_logo = explode('.',$logo_name);
         $extension_logo = end($explode_logo);
         $extensions = ['png', 'jpeg', 'jpg'];

         if(in_array($extension_logo,$extensions) == true){
            $time = time();
            $new_logo_name = $time.$logo_name;

           if(move_uploaded_file($logo_tmp,'../../views/assets/images/logos/'.$new_logo_name)){
            $sql = "INSERT INTO website(siteWeb,email,tele,address,twitter,facebook,youtube,instagrame,logo,QuiSommesNous,AproposDuSite)
            VALUES('$siteWeb','$email','$tele','$address','$twitter','$facebook','$youtube','$instagrame','$new_logo_name','$quiSommesNous','$aproposDuSite')";
            $res = $this ->db ->updateDb($sql);
            echo json_encode([
               'message' => 'bien_inserer',
            ]);

           };

         }else{
            echo json_encode([
               'message' => 'error_logo',
            ]);
         }

      }
;
      

   }

   public function update($data){
      $siteWeb = htmlspecialchars(trim($data['siteWeb']));
      $email = htmlspecialchars(trim($data['email']));
      $tele = htmlspecialchars(trim($_POST['tele']));
      $address = htmlspecialchars(trim($data['address']));
      // $codePostal = htmlspecialchars(trim($data['codePostal']));
      // $ville = htmlspecialchars(trim($data['ville']));
      $twitter = htmlspecialchars(trim($data['twitter']));
      $facebook = htmlspecialchars(trim($data['facebook']));
      $youtube = htmlspecialchars(trim($data['youtube']));
      $instagrame = htmlspecialchars(trim($data['instagrame']));
      $quiSommesNous = htmlspecialchars(trim($data['quiSommesNous']));
      $aproposDuSite = htmlspecialchars(trim($data['aproposDuSite']));

      $webSiteInfo = $this -> db ->selectDb('SELECT * from website LIMIT 1')->fetch(PDO::FETCH_OBJ);
      $new_logo = null;
      if(isset($_FILES['logo']) && empty($_FILES['logo']['name'])) {
         $new_logo = $webSiteInfo->logo;
      } else {
            $pathImage = '../../views/assets/images/logos/'.$webSiteInfo->logo;
            if(file_exists($pathImage))  {
               unlink($pathImage);
               $new_logo_name =  $this->uploadImage();

               if($new_logo_name == 'error_photo'){
                  echo json_encode([
                     'message'=>'error_photo',
                  ]);
               }else{
                  $new_logo = $new_logo_name;
               }
            } else {
               $new_logo_name = $this->uploadImage();
               $new_logo = $new_logo_name;
            }
      }

      $sql = "UPDATE website 
              SET siteWeb =  '$siteWeb', email =  '$email',tele = '$tele' ,address = '$address' ,
              twitter = '$twitter',
              facebook =  '$facebook' ,youtube = '$youtube' , instagrame = '$instagrame',logo = '$new_logo',
              QuiSommesNous = '$quiSommesNous',AproposDuSite = '$aproposDuSite'
            WHERE id = $webSiteInfo->id";
      $stm = $this -> db->updateDb($sql);

      if($stm > 0){
         echo json_encode([
            'message' => 'bien_update',
         ]);
      }else{
         echo json_encode([
            'message' => 'probleme_update',
         ]);
      }
   }
}



if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $webSite = new WebSiteController();

   $webSiteInfo = $webSite -> db ->selectDb('SELECT * FROM website');
   if($webSiteInfo->rowCount() > 0){
      $webSite -> update($_POST);
   }
   else{
      $webSite ->store($_POST);
   }
}


?>