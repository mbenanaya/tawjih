<?php
   session_start();
   include('../models/db.php');
  if(!isset($_SESSION['unique_id_student']))
    {
      header('Location:  http://localhost/tawjihwebsite/se-connecter');

    }else{
    $outgoing_id = $_POST['outgoing_id'];
    $incomming_id = $_POST['incoming_id'];
    $message = $_POST['message'];
// -----------------------------------
// INSERER DATA TO TABLE MESSAGE 
    $db = new Db();
    if(!empty($message))
    {
        $sql = "INSERT INTO messages(outgoing_id,incoming_id,message)  VALUES($outgoing_id,$incomming_id,'$message')";
        $res =$db->updateDb($sql);
    }
  }


?>