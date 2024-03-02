
<?php
require_once 'auth.php';
require_once 'NotificationsController.php';


$cuser = new Auth();
$notif = new NotificationsController();

if(isset($_POST['title'])){
    $title = $cuser->test_input($_POST['title']);
    $titre = $cuser->test_input($_POST['titre']);
    $temps = $cuser->test_input($_POST['temps_restant']);
    $des = $_POST['des'];
    $ecole = $cuser->test_input($_POST['lien-ecole']);
    $video = $cuser->test_input($_POST['lien-video']);
    $bacs = implode(',', $_POST['bacs']);

 
    // image
    $name_image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    
    // pdf
    $name_pdf = $_FILES['pdf']['name'];
    $tmp_pdf = $_FILES['pdf']['tmp_name'];

    // audio
    $name_audio = $_FILES['audio']['name'];
    $tmp_audio = $_FILES['audio']['tmp_name'];

    // video
    $name_video = $_FILES['video']['name'];
    $tmp_video = $_FILES['video']['tmp_name'];


    $full_img_path = '../uploads/articles/images';
    $full_pdf_path = '../uploads/articles/pdfs';
    $full_aud_path = '../uploads/articles/audios';
    $full_vid_path = '../uploads/articles/videos';

    $new_name_image="";
    $new_name_pdf="";
    $new_name_audio="";
    $new_name_video="";
   if(!empty($name_pdf)){
        $new_name_pdf = time().'_'.$name_pdf;
        $pos_pdf = $full_pdf_path.'/'.$new_name_pdf;
        move_uploaded_file($tmp_pdf, $pos_pdf);
   }
   if(!empty($name_image)){
        $new_name_image = time().'_'.$name_image;
        $pos_image = $full_img_path.'/'.$new_name_image;
        move_uploaded_file($tmp_image, $pos_image);
   }
   if(!empty($name_audio)){
        $new_name_audio = time().'_'.$name_audio;
        $pos_audio = $full_aud_path.'/'.$new_name_audio;
        move_uploaded_file($tmp_audio, $pos_audio);
   }
   if(!empty($name_video)){
        $new_name_video = time().'_'.$name_video;
        $pos_video = $full_vid_path.'/'.$new_name_video;
        move_uploaded_file($tmp_video, $pos_video);
   }
    


    $notif_subject = 'مباراة جديدة';
    $notif_text = "تم الاعلان عن $title";
    $currentTime = date('Y-m-d_H:i:s');
    $emailSubject = "تم الاعلان عن مباراة جديدة";

    if($cuser->add_concours($title, $new_name_image, $titre, $new_name_pdf, $new_name_audio, $new_name_video, $temps, $des, $ecole,$video,$bacs)){
        $showNotification = $notif->createNewArticleNotif($notif_subject, $notif_text, $bacs, $title, $currentTime);
        $sendEmail = $notif->sendNewArticleEmail($emailSubject, $bacs, $title);
        echo "login";
    } else {
        echo "error";
    }

}

if(isset($_POST['action']) && $_POST['action']=='display_notes'){
    $output ='';
    $notes = $cuser->get_students();
    $path = "./views/assets/images/logos/";

    if($notes){
        $output.= '<table class="table table-striped text-center">
        <thead>
            <tr>
                <th class="text-center">image</th>
                <th class="text-center">code Massar</th>
                <th class="text-center">cin</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Prenom</th>                 
                <th class="text-center">Statut</th>                 
                <th class="text-center">Action</th> 
                
            </tr>                          
        </thead>
        <tbody>';
        foreach($notes as $row){
            if($row['photo'] != ''){
                $uphoto = $row['photo'];
            }else{
                $uphoto = "./views/assets/images/logos/—Pngtree—user avatar placeholder black_6796227.png";
            }
            $ckecked = '';
            $active = 'Désactiver';
            if($row['statut'] == 2){
                $ckecked = 'checked';
                $active = 'Activer';
            }
            $output .= '<tr>
            <td><img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>

            <td>'.$row['codeMassar'].'</td>
            <td>'.$row['cin'].'</td>
            <td>'.$row['lastName'].'</td>
            <td>'.$row['firstName'].'</td>   

            <td>

            <div class="form-check form-switch">
                <input class="form-check-input activer" value="'.$row['statut'].'" type="checkbox" id="'.$row['codeMassar'].'" '.$ckecked.'>
                <label class="form-check-label" for="flexSwitchCheckChecked">'.$active.'</label>
            </div>
            
            </td>  
                    
            <td>
                <a href="#" id="'.$row['codeMassar'].'"  title="View Details"  class="text-success infoBtn">
                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;
                </a>
                <a href="#" id="'.$row['codeMassar'].'"  title="Delete Note" class="text-danger deleteBtn">
                    <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                <a href="#" id="'.$row['codeMassar'].'" title="Mon lien" class="facture" style="color: #007bff;">
                    <i class="fas fa-file-invoice fa-lg"></i>
                </a>
            </td>
        </tr>';
        }
        $output .= '</tbody></table>';

        echo $output;
    }else{
        echo '<h3 class-"text-center text-secondary"> There is no Student Here </h3>';
    }
    
}


if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];
    $cuser->delete_student($id);
}
if(isset($_POST['info_id'])){     
    $id = $_POST['info_id'];
    $row = $cuser->info_student($id);
    echo json_encode($row);
}

if(isset($_POST['id'])){
    $id = $cuser->test_input($_POST['id']);
    $row = $cuser->edit_article($id);
    echo json_encode($row);  
}



if(isset($_POST['action']) && $_POST['action'] == 'update_note'){
    $id = $cuser->test_input($_POST['article_id']);

    
    $title = $cuser->test_input($_POST['modifier-titre']);


    //image :
    $name_image = $_FILES['modifier-image']['name'];
    $tmp_image = $_FILES['modifier-image']['tmp_name'];
    $full_img_path = '../uploads/articles/images';
    $new_name_image = time().'_'.$name_image;
    $pos_image = $full_img_path.'/'.$new_name_image;


    if(!empty($name_image)) {
        // If a new image is uploaded, move it to the upload folder
        $existing_article = $cuser->selectarticle($id);
$old_image = $existing_article['image'];
if (!empty($old_image)) {
    $old_image_path = $full_img_path.'/'.$old_image;
    if (file_exists($old_image_path)) {
        unlink($old_image_path);
    }
}

move_uploaded_file($tmp_image, $pos_image);
    } else {
        // If no new image is uploaded, use the existing image name from the database
        $existing_article = $cuser->selectarticle($id);
        $new_name_image = $existing_article['image'];
    }

    //pdf
    $name_pdf = $_FILES['modifier-pdf']['name'];
    $tmp_pdf = $_FILES['modifier-pdf']['tmp_name'];
    $full_pdf_path = '../uploads/articles/pdfs';
    $new_name_pdf = time().'_'.$name_pdf;
    $pos_pdf = $full_pdf_path.'/'.$new_name_pdf;
    
    

    if(!empty($name_pdf)) {
        // If a new image is uploaded, move it to the upload folder
        // Supprimer l'ancien fichier PDF
$existing_article = $cuser->selectarticle($id);
$old_pdf = $existing_article['pdf'];
if (!empty($old_pdf)) {
    $old_pdf_path = $full_pdf_path.'/'.$old_pdf;
    if (file_exists($old_pdf_path)) {
        unlink($old_pdf_path);
    }
}

move_uploaded_file($tmp_pdf, $pos_pdf);
    } else {
        // If no new image is uploaded, use the existing image name from the database
        $existing_article = $cuser->selectarticle($id);
        $new_name_pdf = $existing_article['pdf'];
    }

    //audio
    $name_audio = $_FILES['modifier-audio']['name'];
    $tmp_audio = $_FILES['modifier-audio']['tmp_name'];
    $full_audio_path = '../uploads/articles/audios';
    $new_name_audio = time().'_'. $name_audio;
    $pos_audio = $full_audio_path.'/'.$new_name_audio;


    if(!empty($name_audio)) {
        // If a new image is uploaded, move it to the upload folder
        $pos_audio = $full_audio_path.'/'.$new_name_audio;
        // Supprimer l'ancien fichier audio
$existing_article = $cuser->selectarticle($id);
$old_audio = $existing_article['audio'];
if (!empty($old_audio)) {
    $old_audio_path = $full_audio_path.'/'.$old_audio;
    if (file_exists($old_audio_path)) {
        unlink($old_audio_path);
    }
}

move_uploaded_file($tmp_audio, $pos_audio);
    } else {
        // If no new image is uploaded, use the existing image name from the database
        $existing_article = $cuser->selectarticle($id);
        $new_name_audio = $existing_article['audio'];
    }

    // video
    $name_video = $_FILES['modifier-video']['name'];
    $tmp_video = $_FILES['modifier-video']['tmp_name'];
    $full_video_path =  '../uploads/articles/videos';
    $new_name_video = time().'_'.$name_video;
    $pos_video = $full_video_path.'/'.$new_name_video;

    if(!empty($name_video)) {
        // If a new image is uploaded, move it to the upload folder
        // Supprimer l'ancienne vidéo
$existing_article = $cuser->selectarticle($id);
$old_video = $existing_article['video'];
if (!empty($old_video)) {
    $old_video_path = $full_video_path.'/'.$old_video;
    if (file_exists($old_video_path)) {
        unlink($old_video_path);
    }
}

move_uploaded_file($tmp_video, $pos_video);
    } else{
        // If no new image is uploaded, use the existing image name from the database
        $existing_article = $cuser->selectarticle($id);
        $new_name_video = $existing_article['video'];
    }


    $concours = $cuser->test_input($_POST['modifier-concours']);
    $date = $cuser->test_input($_POST['date-concours']);
    $des = $_POST['modifier-description'];
    $ecole = $cuser->test_input($_POST['lien-ecole']);
    $cuser->update_article($title,$new_name_image,$concours,$new_name_pdf,$new_name_audio,$new_name_video,$date,$des,$ecole, $id);

    $notif_subject = 'هناك تحديث';
    $notif_text = "هناك تحديث بخصوص $title";
    $emailSubject = "تحديث جديد";
    $currentTime = date('Y-m-d_H:i:s');
    $notif->createUpdateArticleNotif($notif_subject, $notif_text, $id, $currentTime);
    $notif->sendUpdateArticleEmail($emailSubject, $id);
}
  
  if(isset($_POST['action']) && $_POST['action']  == 'delete_article') {
    $article_id = $_POST['id'];
    // Récupérer les informations de l'article
    $existing_article = $cuser->selectarticle($article_id);
    
    // Supprimer l'image associée
    $image_path = '../uploads/articles/images/' . $existing_article['image'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }
    
    // Supprimer le fichier PDF associé
    $pdf_path = '../uploads/articles/pdfs/' . $existing_article['pdf'];
    if (file_exists($pdf_path)) {
        unlink($pdf_path);
    }
    
    // Supprimer le fichier audio associé
    $audio_path = '../uploads/articles/audios/' . $existing_article['audio'];
    if (file_exists($audio_path)) {
        unlink($audio_path);
    }
    
    // Supprimer le fichier vidéo associé
    $video_path = '../uploads/articles/videos/' . $existing_article['video'];
    if (file_exists($video_path)) {
        unlink($video_path);
    }
    $cuser->delete_article($id);
        
  }

  if(isset($_POST['cin'])){
    $code = $cuser->test_input($_POST['codeMassar']);
    $cin = $cuser->test_input($_POST['cin']);
    $email = $cuser->test_input($_POST['email']);
    $pass = $cuser->test_input($_POST['password']);
    $fn = $cuser->test_input($_POST['firstName']);
    $lsn = $cuser->test_input($_POST['lastName']);
    $fna = $cuser->test_input($_POST['firstNameArabe']);
    $lsna = $cuser->test_input($_POST['lastNameArabe']);

    // Photo
    $name_photo = $_FILES['photo']['name'];
    $tmp_photo = $_FILES['photo']['tmp_name']; 
    $pos_photo = ''; 
    if(!empty($name_photo)){
        $new_name_photo = uniqid().$name_photo;
        $pos_photo = 'profile_images/'.$new_name_photo;
        move_uploaded_file($tmp_photo,"../profile_images/$new_name_photo");
    } 
    //

    $sex = $cuser->test_input($_POST['sex']);
    $bacyear = $cuser->test_input($_POST['bacyear']);
    $lycee = $cuser->test_input($_POST['lycee']);
    $tele = $cuser->test_input($_POST['telephone']);
    $telep = $cuser->test_input($_POST['telephonep']);
    $adresse = $cuser->test_input($_POST['adresse']);
    $placeb = $cuser->test_input($_POST['place']);
    $region =$cuser->test_input($_POST['region']);
    $ville = $cuser->test_input($_POST['ville']);
    $dateb = $cuser->test_input($_POST['dateb']);
    $bac =$cuser->test_input($_POST['bac']);
    $pack =$cuser->test_input($_POST['pack']);
    $responsable =$cuser->test_input($_POST['responsable']);

    $id_student = rand(time(),1000000);

    if($cuser->add_new_student($code ,$id_student,$cin , $email , $pass , $fn , $lsn , $fna , $lsna,$pos_photo ,$sex,$bacyear,$tele , $telep , $adresse,$placeb,$dateb,$bac,$lycee , $ville ,$region,$pack,$responsable)){
            echo "success";
    }else{
        echo "error";
    }

}

/* if (isset($_POST['action']) && ($_POST['action'] == 'get_student_info')) {
    $id = $_POST['id'];
    $student = $cuser->info_student($id);
    $output = '';
    if ($student) {
        $output .= '<div class="container">';
        $output .= '<h1 class="my-4">Détails de l\'utilisateur</h1>';
        $output .= '<table class="table table-bordered">';
        $output .= '<tr><th>Code Massar:</th><td>' . $student['codeMassar'] . '</td></tr>';
        $output .= '<tr><th>CIN:</th><td>' . $student['cin'] . '</td></tr>';
        $output .= '<tr><th>Nom:</th><td>' . $student['lastName'] . '</td></tr>';
        $output .= '<tr><th>Prénom:</th><td>' . $student['firstName'] . '</td></tr>';
        // Ajoutez d'autres données d'utilisateur que vous souhaitez afficher
        $output .= '</table>';
        $output .= '</div>';
    } else {
        $output .= '<p>L\'utilisateur avec le code Massar ' . $id . ' n\'existe pas.</p>';
    }
    echo $output;
}
 */

 if(isset($_POST['changeStatut'])){   
    $statut = $_POST['statut'];
    $id = $_POST['codeMassar'];
    if($cuser->update_actdesact($id,$statut)){
        echo "change";
    }else{
        echo "not change";
    }
}


    



if(isset($_POST['action']) && $_POST['action']=='display_notes_responsables'){
    session_start();
    $idResponsable = $_SESSION['RESPONSABLEINFO']['idRes'];
    $output ='';
    $notes = $cuser->get_students_responsable($idResponsable);
    $path = "./views/assets/images/logos/";
    if($notes){
        $output.= '<table class="table table-striped text-center">
        <thead>
            <tr>
                <th class="text-center">Image</th>
                <th class="text-center">code Massar</th>
                <th class="text-center">cin</th>
                <th class="text-center">nom</th>
                <th class="text-center">prenom</th>  
                <th class="text-center">Statut</th>              
                <th class="text-center">Action</th> 
                
            </tr>                          
        </thead>
        <tbody>';
        foreach($notes as $row){
            if($row['photo'] != ''){
                $uphoto = $row['photo'];
            }else{
                $uphoto = "./views/assets/images/logos/—Pngtree—user avatar placeholder black_6796227.png";
            }
            $ckecked = '';
            $active = 'Désactiver';
            if($row['statut'] == 2){
                $ckecked = 'checked';
                $active = 'Activer';
            }
            $output .= '<tr>
        
            <td><img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>
            <td>'.$row['codeMassar'].'</td>
            <td>'.$row['cin'].'</td>
            <td>'.$row['lastName'].'</td>
            <td>'.$row['firstName'].'</td>  
            <td>

            <div class="form-check form-switch">
                <input class="form-check-input activer" value="'.$row['statut'].'" type="checkbox" id="'.$row['codeMassar'].'" '.$ckecked.'>
                <label class="form-check-label" for="flexSwitchCheckChecked">'.$active.'</label>
            </div>
            
            </td>            
            <td>
                <a href="#" id="'.$row['codeMassar'].'"  title="View Details"  class="text-success infoBtn">
                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;
                </a>
                <a href="#" id="'.$row['codeMassar'].'"  title="Delete Note" class="text-danger deleteBtn">
                    <i class="fas fa-trash-alt fa-lg"></i>
                </a>
                <a href="#" id="'.$row['codeMassar'].'" title="Mon lien" class="facture" style="color: #007bff;">
                    <i class="fas fa-file-invoice fa-lg"></i>
                </a>
            </td>
        </tr>';
        }
        $output .= '</tbody></table>';

        echo $output;
    }else{
        echo '<h3 class-"text-center text-secondary"> There is no Student Here </h3>';
    }
    
}
?>


