<?php


class BacController{
   
   public $data = 'tawjih';

   public function selectAllBac(){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM bac",$this->data);
      return $res;
   }

   public function insertBac($idBac,$sector){
      $db = new Db();
      $res = $db -> updateDb("INSERT INTO bac(idBac,sector) VALUES($idBac,'$sector')",$this->data);
      return $res;

   }

   public function showBac($idBac){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM  bac WHERE idBac = $idBac ",$this->data);
      return $res;
   }

   public function updateBac($idBac,$sector){
      $db = new Db();
      $res = $db->updateDb("UPDATE bac SET sector = '$sector' WHERE idBac = $idBac ",$this->data);
      return $res;
   }

   public function deleteBac($idBac)
   {

      $db = new Db();
      $res = $db -> updateDb("DELETE  FROM bac WHERE idBac = $idBac",$this ->data);
      return $res;

   }
}



?>