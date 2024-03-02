<?php 

session_start();
include "../models/db.php";
include "../boostrap.php";

class CommentaireController {

   public $db;
   public function __construct() {
      $this->db = new Db();
   }
   public function envoyerStudentCommentaire($data) {
      $commentaire = $data['commentaire'];
      $idStudent = $_SESSION['studentInfo']['codeMassar'] ;

      $insertCommentaire = $this -> db ->prepare("INSERT INTO comments(comment,student_CodeMassar) 
                                                VALUES(?,?)");
      if ($insertCommentaire->execute([$commentaire,$idStudent])) {
         echo json_encode([
            'resultat'=>'commentaire_inserted'
         ]);
      } else {
         echo json_encode([
            'resultat'=>'commentaire_not_inserted'
         ]);
      }

   }

   public function gelAllCommentaires() {
      $res = $this->db->selectDb('SELECT * FROM comments , students WHERE  comments.student_CodeMassar = students.codeMassar');
      $commentsHtml = '';
      if ($res->rowCount() > 0) {
         while($row = $res->fetch(PDO::FETCH_OBJ)) {

            $commentsHtml .= '
            
            <li class="list-group-item">
            <div class="row">
                <div class="col-xs-2 col-md-1">
                    <img src="'.$row->photo.'" class="img-circle img-responsive img-user" alt="" style="" /></div>
                <div class="col-xs-10 col-md-11">
                    <div>
                        <h5>'.$row->firstName.' '. $row->lastName.'</h5>
                    </div>
                    <div class="comment-text">
                    '.$row->comment.'
                    </div>
                    <div class="action d-flex justify-content-between align-items-center">
                        <div>
                           <button type="button" class="btn btn-primary" title="Edit" style="font-size: 12px;" 
                           onclick="updateCommentaire('.$row->id.', \''.$row->comment.'\')">
                           <i class="fa-solid fa-pen-to-square"></i>
                           </button>
                           <button type="button" class="btn '.($row->publier == 1 ? "btn-success":"btn-dark").'  title="publier" style="font-size: 12px;" id="publier'.$row->id.'" onclick=changePublier('.$row->id.')>
                           Publier
                           </button>
                           <button type="button" class="btn btn-danger" title="Delete" style="font-size: 12px;" onclick=deleteCommentaire('.$row->id.')>
                              <i class="fa-solid fa-trash"></i>
                           </button>
                        </div>
                        <span>'.date('d-m-Y',strtotime($row->created_at)).'</span>
                    </div>
                </div>
            </div>
        </li>
            
         
            ';
         }
         $commentsHtml .='
         <a href="#" class="btn btn-info btn-sm btn-block" role="button"><span
         class="glyphicon glyphicon-refresh"></span>Plus de Commentaires</a>';
      } else {
         //
      }

      echo json_encode([
         'resultat'=>$commentsHtml
      ]);

   }

   public function deleteCommentaire($idCommentaire) {
      $res = $this -> db->updateDb("DELETE FROM comments WHERE id = $idCommentaire");

      if ($res) {
         echo json_encode([
            'resultat'=>'commentaire_deleted'
         ]);
      } else {
         echo json_encode([
            'resultat'=>'commentaire_not_deleted'
         ]);
      }
   }

   public function changePublier($idCommentaire) {

      $res = $this -> db->selectDb("SELECT * FROM comments WHERE id = $idCommentaire")->fetch(PDO::FETCH_OBJ);

      $valuePuplier = null;
      if ($res ->publier == 0) {
         $valuePuplier = 1 ;
      } else {
         $valuePuplier = 0 ;
      }  

      $updatePuplier = $this->db->updateDb("UPDATE comments
                                          SET publier = $valuePuplier
                                          WHERE id = $idCommentaire");

      if ($updatePuplier) {
         echo json_encode([
            'resultat'=>'publier_updated',
            'value'=>$valuePuplier
         ]);
      } else {
         echo json_encode([
            'resultat'=>'publier_not_updated'
         ]);
      }
   }

   public function modificationCommentaire($data) {
      $idCommentaire = $data['id'];
      $commentaire = htmlspecialchars($data['commentaire']);

      $updateCommentaire = $this->db->prepare("UPDATE comments
                                              SET comment = ?
                                              WHERE id = ?");
      if ($updateCommentaire->execute([$commentaire,$idCommentaire])) {
            echo json_encode([
               'resultat' =>'commentaire_updated'
            ]);
      } else {
            echo json_encode([
               'resultat' =>'commentaire_not_updated'
            ]);
      }
         
   }
}

$commentaire = new CommentaireController();

if (isset($_POST['envoyerStudentCommentaire'])) {
   $commentaire -> envoyerStudentCommentaire($_POST);
}

if (isset($_GET['gelAllCommentaires'])) {
   $commentaire -> gelAllCommentaires();
}

if (isset($_GET['deleteCommentaire'])) {
   $commentaire -> deleteCommentaire($_GET['id']);
}

if (isset($_POST['changePublier'])) {
   $commentaire -> changePublier($_POST['id']);
}

if (isset($_POST['modificationCommentaire'])) {
   $commentaire -> modificationCommentaire($_POST);
}


?>