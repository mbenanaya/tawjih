<?php
session_start();
include "../../models/db.php";
include "../../boostrap.php";

class ResponsableController {
   public $db;
   public function __construct() {
      $this -> db = new Db();
   }
   public function getAllResposables() {
      $resposables = $this->db->selectDb("SELECT * FROM  responsables");
      $output = '';
      
      if($resposables->rowCount() > 0) {
         while($row = $resposables->fetch(PDO::FETCH_OBJ)) {
            $output .="
            <tr>
            <td>
               <img src=".(empty($row->photo) ?'https://bootdey.com/img/Content/avatar/avatar1.png':'./views/assets/images/images-admin/'.$row->photo)."
               alt=''
                  class='avatar-sm rounded-circle me-2' />
            </td>
            <td>".$row->nomRes.' '.$row->prenomRes."</td>
            <td>".$row->emailRes."</td>
            <td>".$row->teleRes."</td>
            <td>".$row->dateEmbaucheRes."</td>
            <td>
               <div class='basic-form' id='btn_switch'>
                  <div class='btnSwitch'>
                     <label class='toggle'>
                        <input type='checkbox' onclick=changeActiveRes(".$row->idRes.") ".($row->active == 1 ? 'checked':'').">
                        <span class='slider'></span>
                     </label>
                  </div>
               </div>
            </td>
            <td>
               <ul class='list-inline mb-0'>
                  <li class='list-inline-item'>
                     <a href='".BASE_URL."/?page=edit-responsable&id=".$row->idRes."' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'
                        class='px-2 text-primary'><i class='bx bx-pencil fs-4'></i></a>
                  </li>
                  <li class='list-inline-item'>
                     <a href='javascript:void(0);'  onclick=deleteResponsable(event,".$row->idRes.")
                        title='Delete' class='px-2 text-danger'><i class='fa-solid fa-trash-can'
                           style='color: #d80e0e;font-size: 20px'></i></a>
                  </li>
               </ul>
            </td>
         </tr>
            ";
         }
      }
      $nbrResActive = $this ->db->selectDb("SELECT * FROM responsables WHERE active = 1");
      $nbrResponsables = $this ->db->selectDb("SELECT * FROM responsables");
      echo json_encode([
         'resultat' => $output,
         'nbrResActive' => $nbrResActive->rowCount(),
         'nbrResponsables' =>$nbrResponsables->rowCount()
      ]);
   }
   private function uploadImage() {
      $photo_name = $_FILES['photo']['name'];
      $photo_type = $_FILES['photo']['type'];
      $photo_tmp = $_FILES['photo']['tmp_name'];

      $explode_photo = explode('.',$photo_name );
      $extension_photo = end($explode_photo);
      $extensions = ['png', 'jpeg', 'jpg'];

      if(in_array($extension_photo,$extensions) == true){
         $time = time();
         $new_photo_name = $time.'_RESPONSABLE_'.$photo_name ;

        if(move_uploaded_file($photo_tmp,'../../views/assets/images/images-admin/'.$new_photo_name)){
          return $new_photo_name;
        };

      }else{
         return 'error_photo';
      }

   }

   public function addResposable($data) {
      $fname = htmlspecialchars(trim($data['fname']));
      $lname = htmlspecialchars(trim($data['lname']));
      $emailRes = htmlspecialchars(trim($data['emailRes']));
      $cinRes = htmlspecialchars(trim($_POST['cinRes']));
      $nomAffichage = htmlspecialchars(trim($data['nomAffichage']));
      $salaireRes = htmlspecialchars(trim($data['salaireRes']));
      $teleRes = htmlspecialchars(trim($data['teleRes']));
      $dateNaissRes = htmlspecialchars(trim($data['dateNaissRes']));
      $dateEmbaucheRes = htmlspecialchars(trim($data['dateEmbaucheRes']));
      $addressRes = htmlspecialchars(trim($data['addressRes']));
      $cnssRes = htmlspecialchars(trim($data['cnssRes']));
      $generateNewNamePhoto = '';
      if(isset($_FILES['photo'])){

         $newName_photo = $this -> uploadImage();

         if($newName_photo == 'error_photo'){
            echo json_encode([
               'message'=>'error_photo',
            ]);
         }else{
            $generateNewNamePhoto = $newName_photo;
         }
      };

      $id_Who_Creatit = $_SESSION['adminInfo']['id'];
      $hashed_password = password_hash($emailRes,PASSWORD_DEFAULT);
      $idRes_gen = rand(time(),1000000);

      $sql = "INSERT INTO responsables(idRes_gen ,cinRes ,nomRes ,prenomRes ,nomAffichage ,teleRes, 
                                       addressRes ,cnssRes ,salaireRes ,dateNaissRes ,dateEmbaucheRes,
                                       emailRes ,passwordRes ,photo ,id_who_created)
               VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stm = $this ->db ->prepare($sql);
      $res = $stm->execute([$idRes_gen,$cinRes,$fname,$lname,$nomAffichage,$teleRes,
                           $addressRes,$cnssRes,$salaireRes,$dateNaissRes,$dateEmbaucheRes,
                           $emailRes,$hashed_password,$generateNewNamePhoto,$id_Who_Creatit]);
      if($res) {
         echo json_encode([
            'message'=>'bien_inserer_responsable',
            'url'=>BASE_URL
            ]);
      }else{
         echo json_encode([
            'message'=>'not_insereted',
            ]);
      }

   }

   public  function deleteResposable($idResponsable) {
      $selectRes = $this->db->selectDb("SELECT * FROM responsables WHERE idRes = $idResponsable")->fetch(PDO::FETCH_OBJ);

      if(file_exists("../../views/assets/images/images-admin/".$selectRes->photo)){
         unlink("../../views/assets/images/images-admin/".$selectRes->photo);
      }
      $responsable = $this-> db->updateDb("DELETE FROM responsables WHERE idRes = $idResponsable");
      if($responsable > 0) {
         $nbrResActive = $this ->db->selectDb("SELECT * FROM responsables WHERE active = 1");
         $nbrResponsables = $this ->db->selectDb("SELECT * FROM responsables");
         echo json_encode([
            'resultat' =>'responsable_deleted',
            'nbrResActive' => $nbrResActive->rowCount(),
            'nbrResponsables' =>$nbrResponsables->rowCount()
         ]);
      } else {
         echo json_encode([
            'resultat' =>'responsable_not_deleted'
         ]);
      }
   }

   public function changeActiveRes($idResponsable) {
      $responsable = $this ->db->selectDb("SELECT * FROM responsables WHERE idRes = $idResponsable")->fetch(PDO::FETCH_OBJ);
      $changeActive = null;
      if($responsable -> active == 1){
         $changeActive = 0;
      }else{
         $changeActive = 1;
      }
      $res = $this ->db ->updateDb("UPDATE responsables SET active =  $changeActive WHERE idRes =  $responsable->idRes");
      if($res > 0){
         $nbrResActive = $this ->db->selectDb("SELECT * FROM responsables WHERE active = 1");
         $nbrResponsables = $this ->db->selectDb("SELECT * FROM responsables");
         echo json_encode([
            'resultat'=>'change_active_resp',
            'nbrResActive' => $nbrResActive->rowCount(),
            'nbrResponsables' =>$nbrResponsables->rowCount()
         ]);
      }else{
      echo json_encode([
            'resultat'=> $idResponsable
         ]);
      }
   }

   public function updateResposable($data) {

      $fname = htmlspecialchars(trim($data['fname']));
      $lname = htmlspecialchars(trim($data['lname']));
      $emailRes = htmlspecialchars(trim($data['emailRes']));
      $cinRes = htmlspecialchars(trim($_POST['cinRes']));
      $nomAffichage = htmlspecialchars(trim($data['nomAffichage']));
      $salaireRes = htmlspecialchars(trim($data['salaireRes']));
      $teleRes = htmlspecialchars(trim($data['teleRes']));
      $dateNaissRes = htmlspecialchars(trim($data['dateNaissRes']));
      $dateEmbaucheRes = htmlspecialchars(trim($data['dateEmbaucheRes']));
      $addressRes = htmlspecialchars(trim($data['addressRes']));
      $cnssRes = htmlspecialchars(trim($data['cnssRes']));
      $idRes =  htmlspecialchars(trim($data['idRes']));
      $photo = '';
      $responsable = $this->db->selectDb("SELECT * FROM responsables WHERE idRes = $idRes")->fetch(PDO::FETCH_OBJ);
      
      // if  responsable don't update the photo
      if(isset($_FILES['photo']) && empty($_FILES['photo']['name'])){
         $photo = $responsable->photo;

      }else{
         if(file_exists("../../views/assets/images/images-admin/".$responsable->photo)){

            unlink("../../views/assets/images/images-admin/".$responsable->photo);
            $new_name_photo = $this->uploadImage();

            if($new_name_photo == 'error_photo'){
               echo json_encode([
                  'message'=>'error_photo',
               ]);
            }else{
               $photo = $new_name_photo;
            }
         }else{
            $new_name_photo = $this->uploadImage();
            $photo = $new_name_photo;
         }
      };
      $sql = "UPDATE  responsables 
      SET cinRes =  ?, nomRes = ?,prenomRes = ?,nomAffichage = ?,teleRes = ?, 
      addressRes = ?,cnssRes = ?,salaireRes = ?,dateNaissRes = ?,dateEmbaucheRes = ?,
      emailRes = ?,photo  = ?
      WHERE idRes = $idRes";

      $stm = $this ->db ->prepare($sql);
      $res = $stm->execute([$cinRes,$fname,$lname,$nomAffichage,$teleRes,
      $addressRes,$cnssRes,$salaireRes,$dateNaissRes,$dateEmbaucheRes,
      $emailRes,$photo]);
      if($res) {
      echo json_encode([
         'resultat'=>'responsable_updated',
         ]);
      }else{
         echo json_encode([
         'resultat'=>'not_updated',
         ]);
      }
   }

   public function changePassword($data) {
      $idRes =$data['idRes'];
      $oldPassword = htmlspecialchars(trim($data['oldPassword']));
      $newPassword = htmlspecialchars(trim($data['newPassword']));
      $responsable =$this->db->selectDb("SELECT * FROM responsables WHERE idRes = $idRes")->fetch(PDO::FETCH_OBJ);

      if(password_verify($oldPassword ,$responsable->passwordRes)) {
         $password_hash = password_hash($newPassword,PASSWORD_DEFAULT);
         $stm = $this->db->updateDb("UPDATE responsables SET passwordRes = '$password_hash' WHERE idRes = $idRes");
         if($stm > 0) {
            echo json_encode([
               'resultat' =>'password_update'
            ]);
         } else {
            echo json_encode([
               'resultat' =>'password_not_update'
            ]);
         }
      } else {
         echo json_encode([
            'resultat' =>'password_not_equal'
         ]);
      }

   }

   public function loginResponsable($data) {

      $email = htmlspecialchars($data['email']);
      $password = $data['password'];

      $resposable = $this -> db -> selectDb("SELECT * FROM responsables WHERE emailRes = '$email'");

      if ($resposable->rowCount() > 0) {
         $resultat = $resposable->fetch(PDO::FETCH_ASSOC);
         if (password_verify($password, $resultat['passwordRes'])) {
            $_SESSION['RESPONSABLEINFO'] = $resultat;
            echo  json_encode([
               'isLogin' => true,
               'url' => BASE_URL,
               'message'=> 'login_correct'
            ]);

         } else {
            echo  json_encode([
               'isLogin' => false,
               'message'=> 'البريد الالكتروني أو كلمة السر غير صحيح'
            ]);
         }
         
      } else {
         echo  json_encode([
            'isLogin' => false,
            'message'=> 'البريد الالكتروني أو كلمة السر غير صحيح'
         ]);
      }
   }

}

$responsable = new ResponsableController();

if(isset($_POST['addResposable'])) {
   $responsable->addResposable($_POST);
}

if(isset($_GET['getAllResposables'])) {
   $responsable->getAllResposables();
}

if(isset($_GET['deleteResposable'])) {
   $idResponsable = $_GET['idResponsable'];
   $responsable->deleteResposable($idResponsable);
}

if(isset($_GET['changeActiveRes'])) {
   $idResponsable = $_GET['idResponsable'];
   $responsable->changeActiveRes($idResponsable);
}

if(isset($_POST['updateRes'])) {
   $responsable->updateResposable($_POST);
}

if(isset($_POST['changePassword'])) {
   $responsable->changePassword($_POST);
}

if(isset($_POST['resonsable_login'])) {
   $responsable->loginResponsable($_POST);
}




?>