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
// GET MESSAGES FROM TABLE MESSAGES
    $db = new Db();
    $sql = "SELECT * FROM messages 
    WHERE (outgoing_id = $outgoing_id   AND incoming_id = $incomming_id)
    OR (outgoing_id = $incomming_id AND incoming_id = $outgoing_id)
    ORDER BY msg_id ";

    $res = $db->selectDb($sql);

    $output = '';
    while($row = $res -> fetch(PDO::FETCH_OBJ))
    {
      if($row->outgoing_id == $outgoing_id){
        $output .= '<div class="chat outgoing">
                      <div class="details">
                            <p>'.$row->message .'</p>
                      </div>
                    </div>
                    ';
      }else{
        $output .=  '<div class="chat incoming">
                        <img src="./views/assets/images/students/photo-profile.jpg" alt="">
                        <div class="details">
                              <p>'.$row->message.'</p>
                        </div>
                      </div>
                    ';
      }
    }

    echo $output;
  }

?>