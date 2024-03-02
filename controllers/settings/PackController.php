<?php
session_start();
include "../../models/db.php";
class PackController {
   public $db;
   public function __construct(){
      $this ->db = new Db();
   }
   public function getAllPacks() {
      $res = $this ->db->selectDb("SELECT * FROM packs");
      $output = '';
      while($row = $res->fetch(PDO::FETCH_OBJ)) {
         $output .='
            <tr>
            <td>'.$row->idPack.'</td>
            <td>'.$row->domaineP.'</td>
            <td>'.$row->prixPack.' DH</td>
            <td class="d-flex justify-content-center">
               <div class="basic-form" id="btn_switch">
                  <div class="btnSwitch">
                     <label class="toggle">
                        <input type="checkbox" '.($row->active == 1 ? "checked":"").' onclick=changeActivePack('.$row->idPack.')>
                        <span class="slider"></span>
                     </label>
                  </div>
               </div>
            </td>
            <td>
               <ul class="list-inline mb-0">
                  <li class="list-inline-item">
                     <a href="#" title="Edit" class="px-2 text-primary" onclick="updatePack('.$row->idPack.')">
                        <i class="bx bx-pencil fs-4"></i>
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <a href="javascript:void(0);" onclick="deletePack('.$row->idPack.')"
                        title="Delete" class="px-2 text-danger" style="color: #d80e0e;font-size: 20px">
                        <i class="fa-solid fa-trash-can"></i>
                     </a>
                  </li>
               </ul>
            </td>
         </tr>
         ';
      }
      echo json_encode([
         'resultat'=>$output
      ]);
   }

   public function addPack($data) {
      $domaine = $data['domaine'];
      $abreviation = $data['abreviation'];
      $avantageOne = $data['avantageOne'];
      $avantageTwo = $data['avantageTwo'];
      $checkboxes = $data['checkboxes'];
      $id_admin = $_SESSION['adminInfo']['id'];
      $color = $data['color'];
      $prix = $data['prix'];
      $conc_ids_bacs = '';
      foreach($checkboxes as $checkItem) {
         if($checkItem['status'] == true) {
            $conc_ids_bacs .= $checkItem['idBac'].'.';
         }
      }
      // $sql = "INSERT INTO packs(domaineP,domaineAbreviationP,avantage1P,avantage2P,prixPack,color,bacs,id_who_created)
      //                   VALUES('$domaine','$abreviation','$avantageOne','$avantageTwo',$prix,'$color','$conc_ids_bacs',$id_admin)";
      $sql = "INSERT INTO packs(domaineP,domaineAbreviationP,avantage1P,avantage2P,prixPack,color,bacs,id_who_created)
                        VALUES(?,?,?,?,?,?,?,?)";
      // $res = $this ->db->updateDb($sql);
      $stm = $this -> db-> prepare($sql);
      $res = $stm->execute([$domaine,$abreviation,$avantageOne,$avantageTwo,$prix,$color,$conc_ids_bacs,$id_admin]);
      if($res) {
         echo json_encode([
            'resultat'=>'pack_inserted'
         ]);
      }else{
         echo json_encode([
            'resultat'=>'pack_no_inserted'
         ]);
      }
   }

   public function deletePack($idPack) {
      $res = $this->db->updateDb("DELETE FROM packs WHERE idPack = $idPack");
      if($res > 0) {
         echo json_encode([
            'resultat'=>'pack_deleted'
         ]);
      }else{
         echo json_encode([
            'resultat'=>'pack_not_deleted'
         ]);
      }
   }
   public function getAllBacs() {
      $res = $this->db->selectDb('SELECT * FROM bac');
      $output = '';
      if($res->rowCount()) {
         while($row = $res->fetch(PDO::FETCH_OBJ)) {
            $output .='
            <div class="col-md-6 d-flex" style="gap:2rem">
            <input type="checkbox" name="bacs'.$row->idBac.'" value='.$row->idBac.' class="bacs">
            <label for="student-name" class="form-label" style="font-size:14px;">'.$row->sectorFR.'</label>
            </div>
            ';
         }
      }
      echo json_encode([
         'resultat'=>$output
      ]);
   }
   public function bacsChecked($idPack) {
      $packs = $this -> db->selectDb("SELECT * FROM packs WHERE idPack = $idPack")->fetch(PDO::FETCH_OBJ);
      $bacs = $this->db->selectDb('SELECT * FROM bac');

      $explods_ids =explode('.',$packs->bacs);
      array_pop($explods_ids);
      $output = '';
      if($bacs->rowCount() > 0) {
         while($row = $bacs->fetch(PDO::FETCH_OBJ)) {
            $output .='
            <div class="col-md-6 d-flex" style="gap:2rem">
            <input type="checkbox" name="bacs'.$row->idBac.'" value="'.$row->idBac.'" class="bacs" '.(in_array($row->idBac,$explods_ids)  ? "checked":"" ).'>
            <label for="student-name" class="form-label" style="font-size:14px;">'.$row->sectorFR.'</label>
            </div>
            ';
         }
      }
      echo json_encode([
         'resultat'=>$output
      ]);
   }
   public function getInfoPack($idPack) {
      $res = $this ->db->selectDb("SELECT * FROM packs WHERE idPack  = $idPack");
      if($res ->rowCount() > 0) {
         echo json_encode([
            'resultat' =>$res->fetch(PDO::FETCH_OBJ)
         ]);
      } else {
         echo json_encode([
            'resultat' =>'error_get_info'
         ]);
      }
   }

   public function updatePack($data) {
      $idPack = $data['idPack'];
      $domaine = $data['domaine'];
      $abreviation = $data['abreviation'];
      $avantageOne = $data['avantageOne'];
      $avantageTwo = $data['avantageTwo'];
      $checkboxes = $data['checkboxes'];
      $color = $data['color'];
      $prix = $data['prix'];
      $conc_ids_bacs = '';
      foreach($checkboxes as $checkItem) {
         if($checkItem['status'] == true) {
            $conc_ids_bacs .= $checkItem['idBac'].'.';
         }
      }
      $sql = "UPDATE packs SET 
                  domaineP = ?,
                  domaineAbreviationP = ?,
                  avantage1P = ?,
                  avantage2P = ?,
                  prixPack = ?,
                  color = ?,
                  bacs = ?
                  WHERE idPack = ?";
      $stm = $this ->db->prepare($sql);
      $res = $stm->execute([$domaine,$abreviation,$avantageOne,$avantageTwo,$prix,$color,$conc_ids_bacs,$idPack]);
      if($res) {
         echo json_encode([
            'resultat'=>'pack_updated'
         ]);
      }else{
         echo json_encode([
            'resultat'=>'pack_non_updated'
         ]);
      }

   }

   public function changeActivePack($idPack) {
      $pack = $this ->db->selectDb("SELECT * FROM packs WHERE idPack = $idPack")->fetch(PDO::FETCH_OBJ);
      $changeActive = null;
      if($pack -> active == 1){
         $changeActive = 0;
      }else{
         $changeActive = 1;
      }
      $res = $this ->db ->updateDb("UPDATE packs SET active =  $changeActive WHERE idPack =  $pack->idPack");
      if($res > 0){
         echo json_encode([
            'resultat'=>'change_active'
         ]);
      }else{
         echo json_encode([
            'resultat'=>'no_change_active',
         ]);
      }
   }
}

$pack = new PackController();


if(isset($_POST['data'])){
   $data = json_decode($_POST['data'],true);
   
   if($data['action'] == 'addPack') {
      $pack->addPack($data);
   }
   if($data['action'] == 'updatePack') {
      $pack->updatePack($data);
   }
   
}

if(isset($_GET['getAllBacs'])) {
   $pack ->getAllBacs();
}

if(isset($_GET['getAllPacks'])) {
   $pack ->getAllPacks();
}

if(isset($_GET['deletePack'])) {
   $idPack = $_GET['idPack'];
   $pack ->deletePack($idPack);
}

if(isset($_GET['getInfoPack'])) {
   $idPack = $_GET['idPack'];
   $pack ->getInfoPack($idPack);
}

if(isset($_GET['bacsChecked'])) {
   $idPack = $_GET['idPack'];
   $pack ->bacsChecked($idPack);
}

if(isset($_GET['changeActivePack'])) {
   $idPack = $_GET['idPack'];
   $pack ->changeActivePack($idPack);
}




?>