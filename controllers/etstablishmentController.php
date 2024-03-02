<?php
include "../models/db.php";
include "../boostrap.php";
$db = new Db();
if (isset($_GET['card_establishment'])) {
    $studentId = $_GET['student'];
    $res = $db->selectDb("SELECT id,title,sector,DATE_FORMAT(last_deadline, '%d-%m-%Y') AS created_at,logo,last_deadline FROM establishments");
    if ($res) {
        while ($row = $res->fetch()) {
            $recus = $recus = $db->selectDb("SELECT * FROM recus WHERE id_establishment=$row[0] AND id_student='$studentId'");
            if ($recus->rowCount() >= 1) {
                echo "<!-- establishment-->
                <div class='project' role='button' id='$row[0]'>                    
                    <div class='row bg-white has-shadow'>
                        <div class='left-col col-lg-6 d-flex align-items-center justify-content-between'>
                            <div class='project-title d-flex align-items-center'>
                                <div class='image has-shadow'><img src='".$row[4]."' alt='logo' class='img-fluid'></div>
                                <div class='text'>
                                    <h3 class='h4'>$row[1]</h3><small>Dernier délai <span class='time text-danger'>$row[3]</span></small>
                                </div>
                            </div>
                            <div class='project-date'><span class='hidden-sm-down'>vous êtes déjà dépôt récus</span></div>
                        </div>

                        <div class='right-col col-lg-6 d-flex align-items-center'>
                            <div class='time text-danger'><i class='fa-solid fa-clipboard-check' style='color: #15d121; font-size:35px'></i></div>
                            <div class='comments'><i class='fa fa-comment-o'></i></div>
                            <div class='project-progress'>
                                <!--<div class='progress'>
                                    <div role='progressbar' style='width: 45%; height: 6px;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100' class='progress-bar bg-red'></div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>";
            } else {
                ;
                echo "<!-- establishment-->               
                <div class='project' role='button' id='$row[0]'>
                    <input type='hidden' value='$row[5]' id='$row[0]$row[0]'/>
                    <div class='row bg-white has-shadow'>
                        <div class='left-col col-lg-6 d-flex align-items-center justify-content-between'>
                            <div class='project-title d-flex align-items-center'>
                                <div class='image has-shadow'><img src='" .$row[4]."' altlogo' class='img-fluid'></div>
                                <div class='text'>
                                    <h3 class='h4'>$row[1]</h3><small>Dernier délai <span class='time text-danger'>$row[3]</span></small>
                                </div>
                            </div>
                            <div class='project-date'><span class='hidden-sm-down'>Le dépôt n'est pas encore</span></div>
                        </div>

                        <div class='right-col col-lg-6 d-flex align-items-center'>
                            <div class='time text-danger'><i class='fa-solid fa-triangle-exclamation' style='color: #dd0e0e;font-size:35px'></i></div>
                            <div class='comments'><i class='fa fa-comment-o'></i></div>
                            <div class='project-progress'>
                                <!--<div class='progress'>
                                    <div role='progressbar' style='width: 45%; height: 6px;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100' class='progress-bar bg-red'></div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>";
            }
        }
    }
}

if (isset($_GET['establishment_id'])) {
    $id = $_GET['establishment_id'];
    $res = $db->selectDb("SELECT * FROM establishments WHERE id=$id");
    if ($res) {
        while ($row = $res->fetch()) {
            echo json_encode($row);
        }
    }
}

if ((isset($_POST['id_establ_for_recu'])) && (isset($_FILES['file']))) {
    $id = htmlspecialchars($_POST['id_establ_for_recu']);
    $code_massar = htmlspecialchars($_POST['code_massare']);
    $name = htmlspecialchars($_FILES['file']['name']);
    $type = htmlspecialchars($_FILES['file']['type']);
    $tmp_name = htmlspecialchars($_FILES['file']['tmp_name']);
    $size = htmlspecialchars($_FILES['file']['size']);

    $file_size_kb = round($size / 1024, 2);
    $file_size_kb = $file_size_kb . ' KB';

    $new_name =  uniqid() . $name;
    $position = "../uploads/recus/" . $new_name;
    move_uploaded_file($tmp_name, $position);
    $res = $db->updateDb("INSERT INTO recus(id_establishment,id_student,newName,oldName,type,size,position) VALUES($id,'$code_massar','$new_name','$name','$type','$file_size_kb','$position')");
    if ($res > 0) {
        $etablisment =  $db->selectDb("SELECT * FROM establishments WHERE id=$id")->fetch(PDO::FETCH_OBJ);
        $student = $db->selectDb("SELECT id_student FROM students WHERE codeMassar = '$code_massar'")->fetch(PDO::FETCH_OBJ);
        $notif_subject = "تم تسجيلك في مؤسسة ";
        $notif_text =  "لقد تم تسجيلك في $etablisment->title";
        $id_student = $student->id_student;
        $created_at = date("Y-m-d_h:i:s");
        $sql = $db->updateDb("INSERT INTO notification(notif_subject, notif_text, id_student, created_at) VALUES ('$notif_subject', '$notif_text', $id_student, '$created_at')");        
        if ($sql > 0) {
            echo 'insert';
        } else {
            echo 'insert and notif not sent';
        }        
    } else {
        echo 'not insert';
    }
}

if (isset($_GET['id_displayFile']) && isset($_GET['codeMassar'])) {    
    $id = $_GET['id_displayFile'];
    $code_massar = $_GET['codeMassar'];
    $res = $db->selectDb("SELECT * FROM recus WHERE id_establishment=$id AND id_student='$code_massar'");
    if ($res) {
        while ($row = $res->fetch()) {
            if ($row['type'] == "application/pdf") {
                echo "<div class='col-lg-3 col-xl-6'>
                        <div class='file-man-box'><a href='' class='file-close' role='button' title='supprimer' id='$row[0]' value='$row[7]'><i class='fa fa-times-circle'></i></a>
                            <div class='file-img-box'><img src='https://coderthemes.com/highdmin/layouts/assets/images/file_icons/pdf.svg' alt='icon'></div><a href='" . BASE_URL . $row['position'] . "' class='file-download' target='_blanck' title='Télècharger'><i class='fa fa-download'></i></a>
                            <div class='file-man-title'>
                                <h5 class='mb-0 text-overflow'>" . $row['oldName'] . "</h5>
                                <p class='mb-0'><small>" . $row['size'] . "</small></p>
                            </div>
                        </div>
                     </div>";
            } elseif ($row['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                echo "<div class='col-lg-3 col-xl-6'>
                        <div class='file-man-box'><a href='' class='file-close' role='button' title='supprimer' id='$row[0]' value='$row[7]'><i class='fa fa-times-circle'></i></a>
                            <div class='file-img-box'><img src='https://coderthemes.com/highdmin/layouts/assets/images/file_icons/doc.svg' alt='icon'></div><a href='" . BASE_URL . $row['position'] . "' class='file-download' target='_blanck' title='Télècharger'><i class='fa fa-download'></i></a>
                            <div class='file-man-title'>
                                <h5 class='mb-0 text-overflow'>" . $row['oldName'] . "</h5>
                                <p class='mb-0'><small>" . $row['size'] . "</small></p>
                            </div>
                        </div>
                     </div>";
            } elseif ($row['type'] == "application/msword") {
                echo "<div class='col-lg-3 col-xl-6'>
                        <div class='file-man-box'><a href='' class='file-close' role='button' title='supprimer' id='$row[0]' value='$row[7]'><i class='fa fa-times-circle'></i></a>
                            <div class='file-img-box'><img src='https://coderthemes.com/highdmin/layouts/assets/images/file_icons/doc.svg' alt='icon'></div><a href='" . BASE_URL . $row['position'] . "' class='file-download' target='_blanck' title='Télècharger'><i class='fa fa-download'></i></a>
                            <div class='file-man-title'>
                                <h5 class='mb-0 text-overflow'>" . $row['oldName'] . "</h5>
                                <p class='mb-0'><small>" . $row['size'] . "</small></p>
                            </div>
                        </div>
                     </div>";
            } elseif ($row['type'] == "image/png") {
                echo "<div class='col-lg-3 col-xl-6'>
                        <div class='file-man-box'><a href='' class='file-close' role='button' title='supprimer' id='$row[0]' value='$row[7]'><i class='fa fa-times-circle'></i></a>
                            <div class='file-img-box'><img src='https://coderthemes.com/highdmin/layouts/assets/images/file_icons/png.svg' alt='icon'></div><a href='" . BASE_URL . $row['position'] . "' class='file-download' target='_blanck' title='Télècharger'><i class='fa fa-download'></i></a>
                            <div class='file-man-title'>
                                <h5 class='mb-0 text-overflow'>" . $row['oldName'] . "</h5>
                                <p class='mb-0'><small>" . $row['size'] . "</small></p>
                            </div>
                        </div>
                    </div>";
            } elseif ($row['type'] == "image/jpeg") {
                echo "<div class='col-lg-3 col-xl-6'>
                        <div class='file-man-box'><a href='' class='file-close' role='button' title='supprimer' id='$row[0]' value='$row[7]'><i class='fa fa-times-circle'></i></a>
                            <div class='file-img-box'><i class='fa fa-file-image-o fa-4x' aria-hidden='true' style='margin-top:30px'></i></div><a href='" . BASE_URL . $row['position'] . "' class='file-download' target='_blanck' title='Télècharger'><i class='fa fa-download'></i></a>
                            <div class='file-man-title'>
                                <h5 class='mb-0 text-overflow'>" . $row['oldName'] . "</h5>
                                <p class='mb-0'><small>" . $row['size'] . "</small></p>
                            </div>
                        </div>
                    </div>";
            } else {
                echo "<div class='col-lg-3 col-xl-6'>
                        <div class='file-man-box'><a href='' class='file-close' role='button' title='supprimer' id='$row[0]' value='$row[7]'><i class='fa fa-times-circle'></i></a>
                            <div class='file-img-box'><i class='fa fa-file fa-4x' aria-hidden='true' style='margin-top:30px'></i></div><a href='" . BASE_URL . $row['position'] . "' class='file-download' target='_blanck' title='Télècharger'><i class='fa fa-download'></i></a>
                            <div class='file-man-title'>
                                <h5 class='mb-0 text-overflow'>" . $row['oldName'] . "</h5>
                                <p class='mb-0'><small>" . $row['size'] . "</small></p>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}

if (isset($_GET['id_file_delete'])) {
    $id = $_GET['id_file_delete'];
    $path_file = $_GET['path_file'];
    $delete = unlink($path_file);
    if ($delete) {
        $res = $db->updateDb("DELETE FROM recus WHERE id=$id");
        if ($res > 0) {
            echo 'delete';
        }
    } else {
        echo 'not delete';
    }
}

// admin inscription of student in establishment /// student have premium pack
if(isset($_POST['action']) && $_POST['action']=='display_notes'){
    $output ='';    
    $notes = $db->selectDb("SELECT * FROM students WHERE id_pack=2 OR id_pack=4 ORDER BY id_pack")->fetchAll(PDO::FETCH_ASSOC);
    $path = "./views/assets/images/logos/";

    if($notes){
        $output.= "<table class='table table-striped text-center'>
        <thead>
            <tr>
                <th class='text-center'>image</th>
                <th class='text-center'>code Massar</th>                
                <th class='text-center'>nom</th>
                <th class='text-center'>prenom</th>   
                <th class='text-center'>pack</th>              
                <th class='text-center'>Infos</th> 
                <th class='text-center'>Action</th> 
                
            </tr>                          
        </thead>
        <tbody>";
        foreach($notes as $row){
            // display pack Title
            $pack = '';
            if($row['id_pack'] == 2){
                $p = $db->selectDb("SELECT domaineP FROM packs WHERE idPack = 2")->fetch();
                $pack = $p["domaineP"];
            }else{
                $p = $db->selectDb("SELECT domaineP FROM packs WHERE idPack = 4")->fetch();
                $pack = $p["domaineP"];
            }
            ////////////////////////////////
            if($row['photo'] != ''){
                $uphoto = $row['photo'];
            }else{
                $uphoto = "./views/assets/images/logos/—Pngtree—user avatar placeholder black_6796227.png";
            }
            $output .= '<tr>
            <td><img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>

            <td>'.$row['codeMassar'].'</td>            
            <td>'.$row['lastName'].'</td>
            <td>'.$row['firstName'].'</td>
            <td>'.$pack.'</td>            
            <td>
                <a href="#" id="'.$row['codeMassar'].'"  title="View Details"  class="text-success infoBtn">
                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;
                </a>
            </td>
            <td>
                <a href="'.BASE_URL.'/inscription-establishment?student='.$row['codeMassar'].'" data-abc="true"><span class="badge badge-primary text-uppercase">inscrire <br/> au l\'établissements</span></a>
            </td>
        </tr>';
        }
        $output .= '</tbody></table>';

        echo $output;
    }else{
        echo '<h3 class-"text-center text-secondary"> There is no Student Here </h3>';
    }
    
}
// admin inscription of student in establishment /// student have premium pack
if(isset($_POST['action']) && $_POST['action']=='display_notes_for_resp'){
    $id_res = htmlspecialchars($_POST['id_responsable']);
    $output ='';    
    $notes = $db->selectDb("SELECT * FROM students WHERE id_pack=2 OR id_pack=4 HAVING id_responsable = $id_res ORDER BY id_pack;")->fetchAll(PDO::FETCH_ASSOC);
    $path = "./views/assets/images/logos/";

    if($notes){
        $output.= "<table class='table table-striped text-center'>
        <thead>
            <tr>
                <th class='text-center'>image</th>
                <th class='text-center'>code Massar</th>                
                <th class='text-center'>nom</th>
                <th class='text-center'>prenom</th>   
                <th class='text-center'>pack</th>              
                <th class='text-center'>Infos</th> 
                <th class='text-center'>Action</th> 
                
            </tr>                          
        </thead>
        <tbody>";
        foreach($notes as $row){
            // display pack Title
            $pack = '';
            if($row['id_pack'] == 2){
                $p = $db->selectDb("SELECT domaineP FROM packs WHERE idPack = 2")->fetch();
                $pack = $p["domaineP"];
            }else{
                $p = $db->selectDb("SELECT domaineP FROM packs WHERE idPack = 4")->fetch();
                $pack = $p["domaineP"];
            }
            ////////////////////////////////
            if($row['photo'] != ''){
                $uphoto = $row['photo'];
            }else{
                $uphoto = "./views/assets/images/logos/—Pngtree—user avatar placeholder black_6796227.png";
            }
            $output .= '<tr>
            <td><img src="'.$uphoto.'" class="rounded-circle" width="40px"></td>

            <td>'.$row['codeMassar'].'</td>            
            <td>'.$row['lastName'].'</td>
            <td>'.$row['firstName'].'</td>
            <td>'.$pack.'</td>            
            <td>
                <a href="#" id="'.$row['codeMassar'].'"  title="View Details"  class="text-success infoBtn">
                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;
                </a>
            </td>
            <td>
                <a href="'.BASE_URL.'/inscription-establishment-resp?student='.$row['codeMassar'].'" data-abc="true"><span class="badge badge-primary text-uppercase">inscrire <br/> au l\'établissements</span></a>
            </td>
        </tr>';
        }
        $output .= '</tbody></table>';

        echo $output;
    }else{
        echo '<h3 class-"text-center text-secondary"> There is no Student Here </h3>';
    }
    
}