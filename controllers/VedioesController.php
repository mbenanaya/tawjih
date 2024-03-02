<?php
session_start();
include "../models/db.php";
include "../boostrap.php";


class VedioesController {

   PUBLIC $db;
   public function __construct() {
      $this -> db = new Db();
   }

   public function traitementArticle() {

      $IdBacStudent = $_SESSION['studentInfo']['idBac'];
      $articles = $this -> db->selectDb("SELECT * FROM  article  ");

      $array_id_articles = [];

      while($article = $articles -> fetch(PDO::FETCH_OBJ)) {
         $id_bac_explode =explode(',',$article -> bacs );
         if (in_array($IdBacStudent,$id_bac_explode)) {
            array_push($array_id_articles,$article->id);
         }
      }
      

      return $array_id_articles;

   }

   function getAllVediosFotStd1($filterDate ,$desc_asc) {
      $FilterD = !empty($filterDate) ? $filterDate : 0 ;
      $IdBacStudent = $_SESSION['studentInfo']['idBac'];
      $articles = $this -> db->selectDb("SELECT * FROM  article WHERE DATEDIFF(CURRENT_DATE,date_concours) <= $FilterD  ORDER BY id $desc_asc");
      $output = '';
      while($article = $articles -> fetch(PDO::FETCH_OBJ)) {
         $id_bac_explode =explode(',',$article -> bacs );
         if (in_array($IdBacStudent,$id_bac_explode)) {
            $output .="
   
            <div class='col-sm-12 col-md-6 col-lg-4 mb-4'>
            <div class='card'>
            ".(!empty($article->lien_video) ? 
            "
            <iframe width='100%' height='215px' src=".$article->lien_video."
            title='YouTube video player' frameborder='0'
            allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
            allowfullscreen></iframe>"
            :
            "
            <video width='100%' height='215px'  controls>
               <source src='./uploads/articles/videos/".$article->video."' type='video/mp4'>
            </video>

            ")."
               <div class='card-body d-flex flex-column'>
                  <a href='#' class='text-center pt-3 pb-3 title-article'>
                        ".$article->titre_article."
                  </a>
                  <small class='text-muted text-center'>".$article->date_concours."</small>
               </div>
            </div>
         </div>

   ";
         }
      }

      if(strlen($output) > 0 ) {
         echo json_encode([
            'resultat' => $output
         ]);
      } else {
         $output .="
                  <div class='col-md-12 py-5 my-5'> 
                     <p class='text-center text-danger'>Il n'y a pas de vidéos disponibles</p>
                  </div>
                  ";
         echo json_encode([
            'resultat' => $output
         ]);
      }


   }

   // public function getAllVediosFotStd() {
      
   //    $idArrticles = $this -> traitementArticle();
   //    $output = '';
   //    if (count($idArrticles) > 0) {
   //       foreach($idArrticles as $idArticle) {
   //          $article = $this -> db->selectDb("SELECT * FROM  article WHERE id = $idArticle")->fetch(PDO::FETCH_OBJ);

   //          $output .="
   
   //                   <div class='col-sm-12 col-md-6 col-lg-4 mb-4'>
   //                   <div class='card'>
   //                   ".(!empty($article->lien_video) ? 
   //                   "
   //                   <iframe width='100%' height='215px' src=".$article->lien_video."
   //                   title='YouTube video player' frameborder='0'
   //                   allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
   //                   allowfullscreen></iframe>"
                     
                     
                     
   //                   :
   //                   "
   //                   <video width='100%' height='215px'  controls>
   //                      <source src='./uploads/articles/videos/".$article->video."' type='video/mp4'>
   //                   </video>

   //                   ")."
   //                      <div class='card-body d-flex flex-column'>
   //                         <a href='#' class='text-center pt-3 pb-3 title-article'>
   //                               ".$article->titre_article."
   //                         </a>
   //                         <small class='text-muted text-center'>".$article->date_concours."</small>
   //                      </div>
   //                   </div>
   //                </div>
         
   //          ";

   //       }
   //    } 
   //    else {
   //       $output .="
   //          <div class='col-md-12 py-5 my-5'> 
   //             <p class='text-center text-danger'>Il n'y a pas de vidéos disponibles</p>
   //          </div>
   //       ";
   //    }

   //    echo json_encode([
   //       'resultat' => $output
   //    ]);
   // }


}


$vedios = new VedioesController();

if (isset($_GET['getAllVediosFotStd'])) {
   $desc_asc = $_GET['desc_asc'];
   $filterDate = $_GET['filterParDate'];
   $vedios -> getAllVediosFotStd1($filterDate,$desc_asc);
}
?>