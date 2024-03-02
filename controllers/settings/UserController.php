<?php
session_start();
include "../../models/db.php";
include "../../boostrap.php";
class UserController{
   public $db;
   private $DB_NAME;
   public function __construct(){
      $this -> db = new Db();
   }

   private function uploadImage(){
      $photo_name = $_FILES['photo']['name'];
      $photo_type = $_FILES['photo']['type'];
      $photo_tmp = $_FILES['photo']['tmp_name'];

      $explode_photo = explode('.',$photo_name );
      $extension_photo = end($explode_photo);
      $extensions = ['png', 'jpeg', 'jpg'];

      if(in_array($extension_photo,$extensions) == true){
         $time = time();
         $new_photo_name = $time.'_ADMIN_'.$photo_name ;

        if(move_uploaded_file($photo_tmp,'../../views/assets/images/images-admin/'.$new_photo_name)){
          return $new_photo_name;
        };

      }else{
         return 'error_photo';
      }

   }
   public function store($data){
      $fname = htmlspecialchars(trim($data['fname']));
      $lname = htmlspecialchars(trim($data['lname']));
      $email = htmlspecialchars(trim($data['email']));
      $tele = htmlspecialchars(trim($_POST['tele']));
      $nomAffichage = htmlspecialchars(trim($data['nomAffichage']));

      if(isset($_FILES['photo'])){

         $newName_photo = $this -> uploadImage();

         if($newName_photo == 'error_photo'){
            echo json_encode([
               'message'=>'error_photo',
            ]);
         }else{
               $id_Who_Creatit = $_SESSION['id_admin'];
               $passord = $email;
               $id_admin = rand(time(),1000000);
               $sql = "INSERT INTO admin(id_admin,fname,lname,tele,nomAffichage,photo,email,password,id_Who_Creatit)
               VALUES($id_admin,'$fname','$lname','$tele','$nomAffichage','$newName_photo','$email','$passord',$id_Who_Creatit)";
               $res = $this ->db ->updateDb($sql);
            echo json_encode([
               'message'=>'bien_inserer',
               'url'=>BASE_URL
            ]);
         }
      };

   }

   public function updateUser($data){
      $fname = htmlspecialchars(trim($data['fname']));
      $lname = htmlspecialchars(trim($data['lname']));
      $email = htmlspecialchars(trim($data['email']));
      $tele = htmlspecialchars(trim($_POST['tele']));
      $nomAffichage = htmlspecialchars(trim($data['nomAffichage']));
      $idUser = htmlspecialchars($data['idUser']);
      $photo = null;
      $user = $this->db->selectDb("SELECT * FROM admin WHERE id = $idUser")->fetch(PDO::FETCH_OBJ);
      
      // if  user don't update the photo
      if(isset($_FILES['photo']) && empty($_FILES['photo']['name'])){
         $photo = $user->photo;

      }else{
         if(file_exists("../../views/assets/images/images-admin/".$user->photo)){

            unlink("../../views/assets/images/images-admin/".$user->photo);
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
      if(!empty($photo)){
         $sql = "UPDATE admin 
         SET fname = '$fname', lname = '$lname' ,tele = '$tele' ,nomAffichage = '$nomAffichage',email = '$email',
         photo = '$photo'
         WHERE id = $user->id";
         $res = $this ->db ->updateDb($sql);
         if($res > 0){
            if($user -> id == $_SESSION['adminInfo']['id']) {
               $_SESSION['adminInfo']['photo'] = $photo;
               echo json_encode([
                  'message'=>'responsable_updated',
               ]);
            } else {
               echo json_encode([
                  'message'=>'update_success',
               ]);
            }
         }else{
            echo json_encode([
            'message'=>'update_failed',
         ]);
}
      }
   }

   public function changeActiveUser($idUser){
      $user = $this ->db->selectDb("SELECT * FROM admin WHERE id = $idUser")->fetch(PDO::FETCH_OBJ);
      $changeActive = null;
      if($user -> active == 1){
         $changeActive = 0;
      }else{
         $changeActive = 1;
      }
      $res = $this ->db ->updateDb("UPDATE admin SET active =  $changeActive WHERE id =  $user->id");
      if($res > 0){
         $users =$this->db->selectDb("SELECT * FROM  admin WHERE active = 1");
         echo json_encode([
            'message'=>'change_active',
            'nbrUsersActive'=>$users->rowCount()
         ]);
      }else{
         echo json_encode([
            'message'=>'no_change_active',
         ]);
      }
   }

   public function deleteUser($idUser){
      $admin = $this->db->selectDb("SELECT * FROM admin WHERE id = $idUser")->fetch(PDO::FETCH_OBJ);

      if(file_exists("../../views/assets/images/images-admin/".$admin->photo)){
         unlink("../../views/assets/images/images-admin/".$admin->photo);
      }

      $stm = $this ->db->updateDb("DELETE FROM admin WHERE id = $idUser");

      if($stm > 0){
         $nbrUsersActive =$this->db->selectDb("SELECT * FROM  admin WHERE active = 1");
         $users =$this->db->selectDb("SELECT * FROM  admin");
         echo json_encode([
            'message'=>'succuss',
            'nbrUsers'=>  $users->rowCount(),
            'nbrUsersActive' =>$nbrUsersActive->rowCount()
         ]);
      }else{
         echo json_encode([
            'message'=>'error_delete_user',
         ]);
      }
   }

   public function changePassword($data){
      $idUser =$data['idUser'];
      $oldPassword = htmlspecialchars(trim($data['oldPassword']));
      $newPassword = htmlspecialchars(trim($data['newPassword']));
      $user =$this->db->selectDb("SELECT * FROM admin WHERE id = $idUser")->fetch(PDO::FETCH_OBJ);

      if($user -> password == $oldPassword){
         $stm = $this->db->updateDb("UPDATE admin SET password = '$newPassword' WHERE id = $idUser");
         if($stm > 0){
            echo json_encode([
               'message' =>'password_update'
            ]);
         }else{
            echo json_encode([
               'message' =>'password_not_update'
            ]);
         }
      }else{
         echo json_encode([
            'message' =>'password_not_equal'
         ]);
      }
}
}



if(isset($_POST['addUser'])){
   $user = new UserController();
   $user ->store($_POST);
}

if(isset($_GET['changeActiveUser'])){
   $idUser = $_GET['id'];
   $user = new UserController();
   $user ->changeActiveUser($idUser);
}

if(isset($_GET['deleteUser'])){
   $idUser = $_GET['id'];
   $user = new UserController();
   $user ->deleteUser($idUser);
}

if(isset($_POST['updateUser'])){
   $user = new UserController();
   $user->updateUser($_POST);
}


if(isset($_POST['changePassword'])){
   $user = new UserController();
   $user->changePassword($_POST);
}
?>