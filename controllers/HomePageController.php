<?php
session_start();
include "../models/db.php";
include "../boostrap.php";

class HomePageController {
   public $db;
   public function __construct() {
      $this -> db = new Db();
   }
   public function traiterPacks_bacs($explods_ids_bac) {
      $conctAbbriviationSec = '';
      foreach($explods_ids_bac as $id) {
         $bacs = $this ->db->selectDb("SELECT * FROM bac WHERE idBac = $id")->fetch(PDO::FETCH_OBJ);
         $conctAbbriviationSec .=$bacs->abbreviation . ', ';
      }
      return $conctAbbriviationSec;
   }
   public function getPacks() {
      $packs = $this ->db->selectDb("SELECT * FROM packs WHERE active = 1 LIMIT 4");
      $output = '';
      if($packs ->rowCount() > 0) {
         while($row = $packs->fetch(PDO::FETCH_OBJ)) {
            $explods_ids_bacs = explode('.',$row->bacs);
            array_pop($explods_ids_bacs);
            $bacs = $this->traiterPacks_bacs($explods_ids_bacs);
            // <p class='m-0 text-white'>POUR BAC : PC, SM, SVT</p
            $output .="
            <div class='col-md-6 col-lg-3 col-12 mb-4 mb-lg-0'>
                <div class='card h-100  overflow-auto' style='border-radius:50px;'>
                    <div class='text-white text-center py-4' style='background-color:".$row->color.";'>
                        <h4 class='m-0 text-white'>".$row->domaineAbreviationP."</h4>
                        <p class='m-0 text-white'>POUR BAC : ".$bacs."</p>
                    </div>
                    <div class='d-flex justify-content-center g-1 py-5'>
                        <h5 class='text-dark'>DH</h5>
                        <div style='margin-left: 10px;' class='text-center'>
                            <h1 class='m-0' style='font-weight: 500;letter-spacing: 2px;'>".$row->prixPack."</h1>
                            <p style='margin-top: -10px;'>Annuel</p>
                        </div>
                    </div>
                    <div style='padding: 0px 15px;'>
                        <div style='height: 90px;'>
                            <span class='text-dark'><i class='fa-solid fa-badge-check'></i></span>
                            <p class='text-center'>".$row->avantage1P."</p>
                        </div>
                        <hr>
                        <div style='height: 90px;'>
                            <p class='text-center'>".$row->avantage2P."</p>
                        </div>
                    </div>
                    <div class='d-flex flex-column justify-content-center text-center mt-1'
                        style='border-radius: 0px 0px 50px 50px;'>
                        <p class='mb-3'>PACK</p>
                        <p>".$row->domaineP."</p>
                        <a href='".BASE_URL."/?page=open-an-account&id_pack=".$row->idPack."' class='btn text-white py-3'
                            style='background-color:".$row->color.";font-size:18px;'>S'inscrire</a>
                    </div>
                </div>
            </div>
            ";
         }
      }
      echo json_encode([
         'resultat'=>$output
      ]);
   }
   public function getInfoWebSite() {
      $infoWebSite = $this->db ->selectDb("SELECT * FROM website LIMIT 1");
      $admin = $this->db ->selectDb("SELECT * FROM admin LIMIT 1");
      echo json_encode([
         'webSiteInfo' => $infoWebSite->fetch(PDO::FETCH_OBJ),
         'adminInfo'=> $admin->fetch(PDO::FETCH_OBJ),
      ]);
   }

   public function getAllCommentaires() {

      $firstRow =$this->db->selectDb("SELECT  * , comments.id as idComment 
         FROM comments , students 
         WHERE  comments.student_CodeMassar = students.codeMassar 
         AND publier = 1")->fetch(PDO::FETCH_OBJ);
      
      $res = $this->db->selectDb("SELECT  * , comments.id as idComment 
         FROM comments , students 
         WHERE  comments.student_CodeMassar = students.codeMassar
         AND publier = 1");
      // $firstIdCmt = $this->db->selectDb("SELECT  * , comments.id as idComment FROM comments , students WHERE  comments.student_CodeMassar = students.codeMassar");

      $commentsHtml = '';
      $carouselItem = '';
      $carouselindicators ='';


      if ($res->rowCount() > 0) {
         $carouselindicators ='<ol class="carousel-indicators">';
         while($row = $res->fetch(PDO::FETCH_OBJ)) {

            $carouselItem .='

            <div class="carousel-item '.($row->idComment == $firstRow->idComment ? 'active' : '') .'">
               <div class="carousel-caption">
                  <h4 class="carousel-title">'.$row->comment.'</h4>
                  <small class="carousel-name"><span class="carousel-name-title">'.$row->lastName.'</span>,'.$row->firstName.'</small>
               </div>
            </div>
            
            ';

            $carouselindicators .='
            <li data-bs-target="#testimonial-carousel" data-bs-slide-to="0" class="'.($row->idComment == $firstRow->idComment? 'active' : '').'">
               <img src="'.$row->photo.'"
                  class="img-fluid rounded-circle avatar-image" alt="avatar">
            </li>
            ';

         }

         $carouselindicators .='</ol>';

      } else {
         $commentsHtml .='';
      }

      // $commentsHtml = $carouselItem .$carouselindicators;
      echo json_encode([
         'resultat'=>$carouselItem . $carouselindicators
      ]);


   }

}

$webSite = new HomePageController();

if(isset($_GET['getInfoWebSite'])) {
   $webSite -> getInfoWebSite();
}

if(isset($_GET['getInfoPacks'])) {
   $webSite -> getPacks();
}

if(isset($_GET['getCommentaires'])) {
   $webSite -> getAllCommentaires();
}
?>