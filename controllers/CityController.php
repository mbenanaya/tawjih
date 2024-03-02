<?php


class CityController{
   
   public $data = 'tawjih';

   public function selectAllCity(){

      $db = new Db();
      $res = $db->selectDb("SELECT * FROM city",$this->data);
      return $res;

   }

   public function insertCity($idCity,$name,$idRegion){
      $db = new Db();
      $res = $db -> updateDb("INSERT INTO city(idCity,name,idRegion) VALUES($idCity,'$name',$idRegion)",$this->data);
      return $res;
   }

   public function showCity($idCity){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM  city WHERE idCity = $idCity ",$this->data);
      return $res;
   }

   public function updateCity($idCity,$name,$idRegion){
      $db = new Db();
      $res = $db->updateDb("UPDATE city SET name = '$name' , idRegion = $idRegion WHERE idCity = $idCity ",$this->data);
      return $res;
   }

   public function deleteCity($idCity)
   {

      $db = new Db();
      $res = $db -> updateDb("DELETE  FROM city WHERE idCity  = $idCity",$this ->data);
      return $res;

   }
}



?>