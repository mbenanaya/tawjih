<?php


class RegionController{

   public $data = 'tawjih';

   public function selectAllRegion(){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM region",$this->data);
      return $res;
   }

   public function insertRegion($idRegion, $name){

      $db = new Db();
      $res = $db -> updateDb("INSERT INTO region(idRegion,name) VALUES($idRegion,'$name')",$this->data);
      return $res;

   }

   public function showRegion($idRegion){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM  region WHERE idRegion  = $idRegion",$this->data);
      return $res;
   }

   public function updateRegion($idRegion, $name){
      $db = new Db();
      $res = $db->updateDb("UPDATE region SET name = '$name' WHERE  idRegion = $idRegion ",$this->data);
      return $res;
   }

   public function deleteRegion($idRegion)
   {

      $db = new Db();
      $res = $db -> updateDb("DELETE  FROM region WHERE idRegion  = $idRegion",$this ->data);
      return $res;

   }


}



?>