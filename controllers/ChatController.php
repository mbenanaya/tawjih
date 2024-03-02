<?php

session_start();
include "../models/db.php";
include "../boostrap.php";
class ChatController{

   public $db;
   public function __construct(){
      $this -> db = new Db();
   }
   

   public function getEtudiant($id_student){
      $etudiant = $this->db->selectDb("SELECT * FROM  studiants WHERE id_student = $id_student")->fetch(PDO::FETCH_OBJ);
      echo json_encode([
         'etudiante'=>$etudiant
      ]);
   }

   // ------------------------
   //---- PARTIE STUDENT
   //------------------------
   public function insertMessage($data){

      $message = $data['message'];

      $idStudent = $_SESSION['studentInfo']['id_student'];

      // Get responsable for this etudiante
      $idStudent = $_SESSION['studentInfo']['id_student'];
      $infoResponsable = $this->db->selectDb("SELECT responsables.* 
                                 FROM  students , responsables 
                                 WHERE students.id_responsable = responsables.idRes  
                                 AND students.id_student= $idStudent")->fetch(PDO::FETCH_OBJ);
      
      $sql = "INSERT INTO messages(outgoing_id,incoming_id,id_student,id_responsable,message) 
               VALUES($idStudent,$infoResponsable->idRes_gen,$idStudent,$infoResponsable->idRes_gen,'$message')";

     $res =  $this -> db ->updateDb($sql);

      if($res > 0){
         echo json_encode([
            'resultat' => 'message_inserted'
         ]);
      }else{
         echo json_encode([
            'resultat' => 'message_non_inserted'
         ]);
      }
   }

   public function getAllMessage($data){

      // Get responsable for this etudiante
      $idStudent = $_SESSION['studentInfo']['id_student'];

      $infoResponsable = $this->db->selectDb("SELECT responsables.* 
                                 FROM  students , responsables 
                                 WHERE students.id_responsable = responsables.idRes  
                                 AND students.id_student= $idStudent")->fetch(PDO::FETCH_OBJ);


      $sql = "SELECT messages.* , responsables.photo as ResponsablePhoto FROM messages , responsables , students 
               WHERE  (messages.id_student = $idStudent AND messages.id_responsable = $infoResponsable->idRes_gen) 
               AND (messages.id_student = students.id_student AND messages.id_responsable = responsables.idRes_gen)
               ORDER BY msg_id";

      $res = $this -> db->selectDb($sql);

      $output = '';
      while($row = $res -> fetch(PDO::FETCH_OBJ))
      {
      if($row->outgoing_id == $idStudent){
         $output .= '<div class="chat outgoing">
                        <div class="details">
                              <p>'.$row->message .'</p>
                        </div>
                     </div>
                     ';
      }else{
         $output .=  '<div class="chat incoming">
                        <img src="./views/assets/images/images-admin/'.$row->ResponsablePhoto.'" alt="">
                        <div class="details">
                              <p>'.$row->message.'</p>
                        </div>
                        </div>
                     ';
      }
      }

      echo json_encode([
         'resultat' => $output
      ]);

   }

   public function chatStdInfoResponsable() {
      $idStudent = $_SESSION['studentInfo']['id_student'];
      $infoResponsable = $this->db->selectDb("SELECT responsables.* 
                                 FROM  students , responsables 
                                 WHERE students.id_responsable = responsables.idRes  
                                 AND students.id_student= $idStudent");

      echo json_encode([
         'resultat' => $infoResponsable->fetch(PDO::FETCH_OBJ)
      ]);
   }

   public function getAllMsgSendFromResp_Ntf(){
      $id_student = $_SESSION['studentInfo']['id_student'];

      $sql = "SELECT * , messages.id_responsable as idRes_gen , COUNT(messages.msg_id) as nbrMsgEtd , responsables.photo as responsablePhoto
      FROM messages, responsables , students 
      WHERE (messages.id_student = students.id_student AND messages.id_responsable = responsables.idRes_gen)
      AND (messages.id_student = $id_student AND messages.id_responsable = responsables.idRes_gen )
      AND messages.outgoing_id = messages.id_responsable AND messages.status = 0
      GROUP BY messages.id_responsable
      ORDER BY messages.created_at DESC";
      
      $res = $this->db->selectDb($sql);
      
      $output = '';
      if($res->rowCount()>0){
         $output = '
         <li class="dropdown-header"> Vous avez '.$res->rowCount().' nouveaux messages <a href="#"><span
         class="badge rounded-pill bg-primary p-2 ms-2">Voir tout</span></a></li>
         <li>
            <hr class="dropdown-divider">
         </li>
         ';
      
      while($row = $res->fetch(PDO::FETCH_OBJ)){
         $message = $row->message;
         (strlen($message)>20 ? $msg = substr($message,0,20).'...' :$msg=$message);
         ($row->outgoing_id == $row->id_student ? $you = 'Vous':$you='');
         $output .='
         <li class="message-item">
            <a href="'.BASE_URL.'/?page=chat-width-responsable&id='.$row->idRes_gen.'">
               <img src="./views/assets/images/images-admin/'.$row->responsablePhoto.'" alt="" class="rounded-circle">
               <div style="width: 100%;margin-top: -5px;">
                  <div class="d-flex justify-content-between">
                     <h3 class="m-0" style="">'.strtolower($row->nomRes).' '.strtolower($row->prenomRes).'</h3>
                     <small class="time text-muted">Just now</small>
                  </div>
                  <div class="d-flex justify-content-between">
                     <p class="text-muted m-0" style="font-size: 14px;margin: 0px 0px;">'.$you. ' '.$msg.'</p>
                     <span class="bg-danger text-white d-flex align-items-center"
                        style="padding: 0.4px 10px;border-radius:30%;font-size: 10px;">'.$row->nbrMsgEtd.'</span>
                  </div>
               </div>
            </a>
         </li>
         <li>
            <hr class="dropdown-divider">
         </li>';
      }
         $output .='<li class="dropdown-footer" style="text-decoration:none"> <a href="#">Show all messages</a></li>';
      }else{
         $output .='<li class="dropdown-footer" style="text-decoration:none"> <a href="#">Il n y a pas de message</a></li>';
      }
      echo json_encode([
               'resultat' =>$output,
               'nbrNotifacationMsg'=>$res->rowCount()
         ]);

   }

   public function getAllMsgComeFromResp($data){

      $id_responsable  = $data['id_responsable']; // admin 
      $id_student = $_SESSION['studentInfo']['id_student']; // student login send message

      $sql2 = "UPDATE messages
               SET status = 1
               WHERE messages.outgoing_id = $id_responsable AND messages.incoming_id = $id_student";

      $this->db->updateDb($sql2);


      $sql = "SELECT messages.* , responsables.photo as photoResp  FROM messages , responsables , students
               WHERE (messages.id_student = students.id_student AND messages.id_responsable = responsables.idRes_gen)
               AND (messages.id_student = $id_student AND messages.id_responsable = $id_responsable) 
               ORDER BY msg_id";

      $res = $this -> db->selectDb($sql);
      $infoResp = $this -> db->selectDb("SELECT * FROM responsables WHERE  idRes_gen = $id_responsable");

      $output = '';
      while($row = $res -> fetch(PDO::FETCH_OBJ))
      {
      if($row->outgoing_id == $id_student) {
         $output .= '<div class="chat outgoing">
                        <div class="details">
                              <p>'.$row->message .'</p>
                        </div>
                     </div>
                     ';
      } else {
         $output .=  '<div class="chat incoming">
                        <img src="./views/assets/images/images-admin/'.$row->photoResp.'" alt="">
                        <div class="details">
                              <p>'.$row->message.'</p>
                        </div>
                        </div>
                     ';
      }
      }

      echo json_encode([
         'resultat' =>$output,
         'infoResp'=>  $infoResp ->fetch(PDO::FETCH_OBJ)
      ]);

   }
      public function sendStudentMsgToResp($data){

      $id_responsable = $data['id_responsable'];
      // Get responsable for this etudiante
      $idStudent = $_SESSION['studentInfo']['id_student'];

      $message = $data['message'];
      
      $sql = "INSERT INTO messages(outgoing_id,incoming_id,id_student,id_responsable,message) 
               VALUES($idStudent,$id_responsable,$idStudent,$id_responsable,'$message')";

      $res =  $this -> db ->updateDb($sql);
 
       if($res > 0){
          echo json_encode([
             'resultat' => 'message_inserted'
          ]);
       }else{
          echo json_encode([
             'resultat' => 'message_non_inserted'
          ]);
       }
}
   // ------------------------
   //----   END  PARTIE STUDENT
   //---- start   PARTIE Responsable
   //------------------------
   public function getNotifMsgForResponsable(){

      $idRespoLogin =$_SESSION['RESPONSABLEINFO']['idRes_gen'];

      $sql = "SELECT * ,COUNT(messages.msg_id) as nbrMsgEtd
      FROM messages, students 
      WHERE ( messages.id_student = students.id_student 
      AND messages.id_responsable = $idRespoLogin )
      AND ( messages.outgoing_id = messages.id_student AND messages.status = 0 )
      GROUP BY messages.id_student
      ORDER BY messages.created_at";

      $res = $this -> db->selectDb($sql);

      $output = '';
      if($res->rowCount()>0){
         $output = '
         <li class="dropdown-header"> Vous avez '.$res->rowCount().' nouveaux messages <a href="#"><span
         class="badge rounded-pill bg-primary p-2 ms-2">Voir tout</span></a></li>
         <li>
            <hr class="dropdown-divider">
         </li>
         ';
      
      while($row = $res->fetch(PDO::FETCH_OBJ)){
         $message = $row->message;
         (strlen($message)>20 ? $msg = substr($message,0,20).'...' :$msg=$message);
         ($row->outgoing_id == $idRespoLogin ? $you = 'Vous':$you='');
         $output .='
         <li class="message-item">
            <a href="'.BASE_URL.'/?page=chat-with-student-or-admin&typeUser=student&id='.$row->id_student.'">
               <img src='.$row->photo.' alt="" class="rounded-circle">
               <div style="width: 100%;margin-top: -5px;">
                  <div class="d-flex justify-content-between">
                     <h3 class="m-0" style="">'.strtolower($row->firstName).' '.strtolower($row->lastName).'</h3>
                     <small class="time text-muted">Just now</small>
                  </div>
                  <div class="d-flex justify-content-between">
                     <p class="text-muted m-0" style="font-size: 14px;margin: 0px 0px;">'.$you. ' '.$msg.'</p>
                     <span class="bg-danger text-white d-flex align-items-center"
                        style="padding: 0.4px 10px;border-radius:30%;font-size: 10px;">'.$row->nbrMsgEtd.'</span>
                  </div>
               </div>
            </a>
         </li>
         <li>
            <hr class="dropdown-divider">
         </li>';
      }
      $output .='<li class="dropdown-footer" style="text-decoration:none"> <a href="#">Show all messages</a></li>';
   }else{
      $output .='<li class="dropdown-footer" style="text-decoration:none"> <a href="#">Il n y a pas de message</a></li>';
   }
   echo json_encode([
         'resultat' =>$output,
         'nbrNotifacationMsg'=>$res->rowCount()
      ]);

   }

   public function getAllMsgStudentForResp($id_student){

      $idRespoLogin =$_SESSION['RESPONSABLEINFO']['idRes_gen'];

      $sql = "SELECT messages.* , responsables.photo as responsablePhoto , students.*
      FROM messages, students, responsables
      WHERE (messages.id_student = students.id_student AND messages.id_responsable = responsables.idRes_gen)
      AND ((messages.outgoing_id = $idRespoLogin AND messages.incoming_id = $id_student)
      OR (messages.outgoing_id = $id_student AND messages.incoming_id = $idRespoLogin))
      ORDER BY messages.msg_id";

      $sql2 = "UPDATE messages
               SET status = 1
               WHERE messages.outgoing_id = $id_student AND messages.incoming_id = $idRespoLogin";

      $this->db->updateDb($sql2);
      $res = $this -> db->selectDb($sql);

      $output = '';

      while($row = $res -> fetch(PDO::FETCH_OBJ))
      {
      if($row->outgoing_id == $idRespoLogin) {
         $output .= '<div class="chat outgoing">
                        <div class="details">
                              <p>'.$row->message .'</p>
                        </div>
                     </div>
                     ';
      } else {
         $output .=  '<div class="chat incoming">
                        <img src="./views/assets/images/images-admin/'.$row->responsablePhoto.'" alt="">
                        <div class="details">
                              <p>'.$row->message.'</p>
                        </div>
                        </div>
                     ';
      }
      }
      
      $etudiant = $this->db->selectDb("SELECT * FROM students WHERE id_student = $id_student");

      echo json_encode([
         'resultat'=>$output,
         'etudiante'=>$etudiant->fetch(PDO::FETCH_OBJ)
      ]);
   }

   public function sendRespMsgToEtudiant($data) {
      $id_student = $data['id_student'];
      $idRespoLogin =$_SESSION['RESPONSABLEINFO']['idRes_gen'];

      $message = $data['message'];

      $sql = "INSERT INTO messages(outgoing_id,incoming_id,id_student,id_responsable,message) 
               VALUES($idRespoLogin,$id_student,$id_student, $idRespoLogin,'$message')";

      $res =  $this -> db ->updateDb($sql);
 
       if($res > 0){
          echo json_encode([
             'resultat' => 'message_inserted'
          ]);
       }else{
          echo json_encode([
             'resultat' => 'message_non_inserted'
          ]);
       }

   }

   function nbrMsgSendStdNotVue($idStudent) {

      $idRespoLogin =$_SESSION['RESPONSABLEINFO']['idRes_gen'];
      $sql = "SELECT  COUNT(messages.msg_id) as nbrMsgEtd
      FROM messages, students 
      WHERE ( messages.id_student = students.id_student 
      AND messages.id_responsable = $idRespoLogin  AND messages.id_student = $idStudent)
      AND ( messages.outgoing_id = messages.id_student)  AND status = 0";
      
      $nbrMsg = $this->db->selectDb($sql)->fetch(PDO::FETCH_OBJ);

      return  $nbrMsg->nbrMsgEtd ;

   }
   //thoses function for page messages-responsable
   public function getAllMessagesStudentToPgMessagesForRes() {
      //
      $idRespoLogin =$_SESSION['RESPONSABLEINFO']['idRes_gen'];

      $sql = "SELECT * , COUNT(messages.msg_id) as nbrMsgEtd
      FROM messages, students 
      WHERE ( messages.id_student = students.id_student 
      AND messages.id_responsable = $idRespoLogin )
      AND ( messages.outgoing_id = messages.id_student OR messages.outgoing_id = messages.id_responsable)
      GROUP BY messages.id_student , messages.id_responsable
      ORDER BY messages.created_at DESC";


      $res = $this -> db->selectDb($sql);

      $output = '';
      if($res->rowCount()>0){
         // .BASE_URL.'/?page=chat-with-student-or-admin&id=
         while($row = $res->fetch(PDO::FETCH_OBJ)){

            $message = $row->message;
            [$hour, $minutes] = explode(':', date('H:i', strtotime($row->created_at)));
            (strlen($message)>20 ? $msg = substr($message,0,20).'...' :$msg=$message);
            ($row->outgoing_id == $idRespoLogin ? $you = 'Vous':$you='');


            $nbrMsgSendStdNotVue = $this->nbrMsgSendStdNotVue($row->id_student);

            $output .='
            
               <div class="row sideBar-body">
               <a href="'.BASE_URL.'/?page=chat-with-student-or-admin&typeUser=student&id='.$row->id_student.'">
               <div class="col-sm-3 col-xs-3 sideBar-avatar">
                  <div class="avatar-icon">
                     <img src="'.$row->photo.'">
                  </div>
               </div>
               <div class="col-sm-9 col-xs-9 sideBar-main">
                  <div class="row">
                     <div class="col-sm-8 col-xs-8 sideBar-name">
                        <span class="name-meta">'.$row->firstName .' '. $row->lastName.'</span>
                        <p>'.$you.' '.$msg.'</p>
                     </div>
                     <div class="col-sm-4 col-xs-4 pull-right sideBar-time" style="display: flex;justify-content: end;flex-direction:column;">
                        <div style="height:30px;width: 30px;right: 0px;">
                           <span class="time-meta pull-right">'.$hour.":".$minutes.'</span>
                        </div>
                        <div 
                        style="width: 20px; height:20px;border-radius:30%
                        ;background-color: red;color: white;font-size: 10px;margin-top: -10px;display: flex;justify-content: center;align-items: center;">
                        '.$nbrMsgSendStdNotVue.'
                        </div>
                     </div>
                  </div>
               </div>
               </a>
               </div>
            

            ';


         }
      } else {
         $output .='
            <div class="col-sm-12">
               <p class="text-center">Aucun message trouvé</p>
            </div>
         ';
      }

      echo json_encode([
         'resultat' => $output,
         'listAdmins' => $this -> getAllAdmins()
      ]);

   }


   public function getAllAdmins() {
      $sql = "SELECT * FROM admin";
      $res = $this->db->selectDb($sql);

      $output = '';
      while ($row = $res->fetch(PDO::FETCH_OBJ)) {
         

         $output .='
            
         <div class="row sideBar-body">
         <a href="'.BASE_URL.'/?page=chat-with-student-or-admin&typeUser=admin&id='.$row->id_admin.'">
         <div class="col-sm-3 col-xs-3 sideBar-avatar">
            <div class="avatar-icon">
               <img src="./views/assets/images/images-admin/'.$row->photo.'">
            </div>
         </div>
         <div class="col-sm-9 col-xs-9 sideBar-main">
            <div class="row">
               <div class="col-sm-8 col-xs-8 sideBar-name">
                  <span class="name-meta">'.$row->fname .' '. $row->lname.'</span>
                  <p></p>
               </div>
               <div class="col-sm-4 col-xs-4 pull-right sideBar-time" style="display: flex;justify-content: end;flex-direction:column;">
                  <div style="height:30px;width: 30px;right: 0px;">
                     <span class="time-meta pull-right">16:00</span>
                  </div>
                  <div 
                  style="width: 20px; height:20px;border-radius:30%
                  ;background-color: red;color: white;font-size: 10px;margin-top: -10px;display: flex;justify-content: center;align-items: center;">
                  1
                  </div>
               </div>
            </div>
         </div>
         </a>
         </div>
      

      ';
      }

      return $output;
   }

   //send message to Admin
   public function sendRespMsgToAdmin($data) {
      $id_admin = $data['id_admin'];
      $idRespoLogin =$_SESSION['RESPONSABLEINFO']['idRes_gen'];

      $message = $data['message'];

      $sql = "INSERT INTO messages(outgoing_id,incoming_id,id_responsable,id_admin,message) 
               VALUES($idRespoLogin,$id_admin,$idRespoLogin, $id_admin,'$message')";

      $res =  $this -> db ->updateDb($sql);
 
       if($res > 0){
          echo json_encode([
             'resultat' => 'message_inserted'
          ]);
       }else{
          echo json_encode([
             'resultat' => 'message_non_inserted'
          ]);
       }
   }
   
   public function getAllMsgBetweenResAdminLoginRes($data) {
      $id_admin = $data['id_admin'];
      $idRespoLogin =$_SESSION['RESPONSABLEINFO']['idRes_gen'];

      $sql = "SELECT messages.* , admin.photo as adminPhoto , admin.*
      FROM messages, admin , responsables
      WHERE (messages.id_admin = admin.id_admin AND messages.id_responsable = responsables.idRes_gen)
      AND ((messages.outgoing_id = $idRespoLogin AND messages.incoming_id = $id_admin)
      OR (messages.outgoing_id = $id_admin AND messages.incoming_id = $idRespoLogin))
      ORDER BY messages.created_at";

      $sql2 = "UPDATE messages
               SET status = 1
               WHERE messages.outgoing_id = $id_admin AND messages.incoming_id = $idRespoLogin";

      $this->db->updateDb($sql2);
      $res = $this -> db->selectDb($sql);

      $output = '';

      while($row = $res -> fetch(PDO::FETCH_OBJ))
      {
         if($row->outgoing_id == $idRespoLogin) {
            $output .= '<div class="chat outgoing">
                           <div class="details">
                                 <p>'.$row->message .'</p>
                           </div>
                        </div>
                        ';
         } else {
            $output .=  '<div class="chat incoming">
                           <img src="./views/assets/images/images-admin/'.$row->adminPhoto.'" alt="">
                           <div class="details">
                                 <p>'.$row->message.'</p>
                           </div>
                           </div>
                        ';
         }
      }

      echo json_encode([
         'typeUser' => 'admin',
         'resultat' => $output,
         'infoAdmin' =>$this->db->selectDb("SELECT * FROM admin WHERE admin.id_admin = $id_admin")->fetch(PDO::FETCH_OBJ)
      ]);


   }

   //--------------------------------------------------------
   //   PARTIE ADMIN
   //--------------------------------------------------------
   public function getMsgsNotificationForAdmin() {

      $idAdmminLogin = $_SESSION['adminInfo']['id_admin'];

      $sql = "SELECT * , responsables.photo as photoRes , COUNT(messages.msg_id) as nbrMsgs
            FROM messages, admin , responsables
            WHERE ( messages.id_admin = admin.id_admin AND messages.id_responsable = responsables.idRes_gen)
            AND ( messages.outgoing_id = messages.id_responsable AND messages.status = 0 )
            AND messages.id_admin = $idAdmminLogin 
            GROUP BY messages.id_responsable
            ORDER BY messages.msg_id";

      $res = $this -> db->selectDb($sql);

      $output = '';
      if($res->rowCount()>0){
         $output = '
         <li class="dropdown-header"> Vous avez '.$res->rowCount().' nouveaux messages <a href="#"><span
         class="badge rounded-pill bg-primary p-2 ms-2">Voir tout</span></a></li>
         <li>
            <hr class="dropdown-divider">
         </li>
         ';
      
      while($row = $res->fetch(PDO::FETCH_OBJ)){
         $message = $row->message;
         (strlen($message)>20 ? $msg = substr($message,0,20).'...' :$msg=$message);

         $output .='
         <li class="message-item">
            <a href="'.BASE_URL.'/?page=chat-admin-with-resp-or-std&typeUser=responsable&id='.$row->id_responsable.'">
               <img src="./views/assets/images/images-admin/'.$row->photoRes.'" alt="" class="rounded-circle">
               <div style="width: 100%;margin-top: -5px;">
                  <div class="d-flex justify-content-between">
                     <h3 class="m-0" style="">'.strtolower($row->nomRes).' '.strtolower($row->prenomRes).'</h3>
                     <small class="time text-muted">Just now</small>
                  </div>
                  <div class="d-flex justify-content-between">
                     <p class="text-muted m-0" style="font-size: 14px;margin: 0px 0px;">'.$msg.'</p>
                     <span class="bg-danger text-white d-flex align-items-center"
                        style="padding: 0.4px 10px;border-radius:30%;font-size: 10px;">'.$row->nbrMsgs.'</span>
                  </div>
               </div>
            </a>
         </li>
         <li>
            <hr class="dropdown-divider">
         </li>';
      }
      $output .='<li class="dropdown-footer" style="text-decoration:none"> <a href="#">Show all messages</a></li>';
   }else{
      $output .='<li class="dropdown-footer" style="text-decoration:none"> <a href="#">Il n y a pas de message</a></li>';
   }
   echo json_encode([
         'resultat' =>$output,
         'nbrNotifacationMsg'=>$res->rowCount()
      ]);
   }

   public function getAllMsgRespForAdmin($data) {

      $id_responsable = $data['id_responsable'];
      $idAdmminLogin = $_SESSION['adminInfo']['id_admin'];

      $sql = "SELECT messages.* , responsables.photo as respPhoto 
      FROM messages, admin , responsables
      WHERE (messages.id_admin = admin.id_admin AND messages.id_responsable = responsables.idRes_gen)
      AND ((messages.outgoing_id = $id_responsable AND messages.incoming_id = $idAdmminLogin)
      OR (messages.outgoing_id = $idAdmminLogin AND messages.incoming_id = $id_responsable))
      ORDER BY messages.msg_id";

      $sql2 = "UPDATE messages
               SET status = 1
               WHERE messages.outgoing_id = $id_responsable AND messages.incoming_id = $idAdmminLogin";

      $this->db->updateDb($sql2);
      $res = $this -> db->selectDb($sql);

      $output = '';

      while($row = $res -> fetch(PDO::FETCH_OBJ))
      {
         if($row->outgoing_id == $idAdmminLogin) {
            $output .= '<div class="chat outgoing">
                           <div class="details">
                                 <p>'.$row->message .'</p>
                           </div>
                        </div>
                        ';
         } else {
            $output .=  '<div class="chat incoming">
                           <img src="./views/assets/images/images-admin/'.$row->respPhoto.'" alt="">
                           <div class="details">
                                 <p>'.$row->message.'</p>
                           </div>
                           </div>
                        ';
         }
      }

      echo json_encode([
         'typeUser' => 'responsable',
         'resultat' => $output,
         'infoResponsable' =>$this->db->selectDb("SELECT * FROM responsables WHERE responsables.idRes_gen = $id_responsable ")->fetch(PDO::FETCH_OBJ)
      ]);


   }

   public function sendAdmpMsgToResponsable($data) {

      $id_responsable = $data['id_responsable'];
      $idAdmminLogin = $_SESSION['adminInfo']['id_admin'];

      $message = $data['message'];

      $sql = "INSERT INTO messages(outgoing_id,incoming_id,id_responsable,id_admin,message) 
               VALUES($idAdmminLogin,$id_responsable,$id_responsable,$idAdmminLogin,'$message')";

      $res =  $this -> db ->updateDb($sql);
 
       if($res > 0){
          echo json_encode([
             'resultat' => 'message_inserted'
          ]);
       }else{
          echo json_encode([
             'resultat' => 'message_non_inserted'
          ]);
       }

   }

}
$chat = new ChatController();

if(isset($_POST['isertMessage'])){
   $chat ->insertMessage($_POST);
}

if(isset($_POST['getAllMessage'])){
   $chat ->getAllMessage($_POST);
}

// -----------------------------
// ----- PARTIE STUDENT --------
// -----------------------------

if (isset($_GET['chatStdInfoResponsable'])) {
   $chat -> chatStdInfoResponsable();
}

if(isset($_POST['getAllMsgSendFromResp_Ntf'])){
   $chat->getAllMsgSendFromResp_Ntf();
}

if(isset($_POST['getAllMsgComeFromResp'])){
   $chat->getAllMsgComeFromResp($_POST);
}

if(isset($_POST['sendStudentMsgToResp'])){
   $chat->sendStudentMsgToResp($_POST);
}

// ---------------------------------
// ----- PARTIE Responsable --------
// --------------------------------
if (isset($_POST['getNotifMsgForResponsable'])) {
   $chat -> getNotifMsgForResponsable();
}

if(isset($_POST['getAllMsgStudentOrAdminForResp'])){


   if ($_POST['typeUser'] == 'student') {
      $chat->getAllMsgStudentForResp($_POST['id_student']);
   } else {
      $chat -> getAllMsgBetweenResAdminLoginRes($_POST);
   }

}

if(isset($_POST['sendRespMsgToEtudiantOrAdmin'])){

   if ($_POST['typeUser'] == 'student') {
      $chat ->sendRespMsgToEtudiant($_POST);
   } else {
      $chat -> sendRespMsgToAdmin($_POST);
   }

}

if (isset($_POST['getAllMessagesStudentToPgMessagesForRes'])) {
   $chat -> getAllMessagesStudentToPgMessagesForRes();
}

//PARTIE ADMIN
if(isset($_POST['getMsgsNotificationForAdmin'])){
   $chat ->getMsgsNotificationForAdmin();
}

if(isset($_POST['getAllMsgStudentOrRespForAdmin'])){

   if ($_POST['typeUser'] == 'responsable') {
      $chat->getAllMsgRespForAdmin($_POST);
   } else {
      // $chat -> getAllMsgRespForAdmin($_POST);
   }

}

if(isset($_POST['sendAdmnMsgToEtudiantOrResp'])){

   if ($_POST['typeUser'] == 'responsable') {
      $chat ->sendAdmpMsgToResponsable($_POST);
   } else {
      // $chat -> sendRespMsgToAdmin($_POST);
   }

}

?>