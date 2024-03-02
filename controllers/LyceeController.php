<?php


class LyceeController{

   public $data = 'tawjih';

   public function selectAllLycee(){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM lycee",$this->data);
      return $res;
   }

   public function insertLycee($idLycee,$nameLycee,$idVille){
      $db = new Db();
      $res = $db -> updateDb("INSERT INTO lycee(idLycee, name, idVille) VALUES($idLycee,'$nameLycee',$idVille)",$this->data);
      return $res;
   }

   public function showLycee($idLycee){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM  lycee WHERE idLycee = '$idLycee' ",$this->data);
      return $res;
   }


   public function updateLycee($idLycee,$nameLycee,$idVille){
      $db = new Db();
      $res = $db->updateDb("UPDATE lycee SET name = '$nameLycee' , idVille = $idVille   WHERE idLycee = $idLycee",$this->data);
      return $res;
   }

   public function deleteLycee($idLycee)
   {

      $db = new Db();
      $res = $db -> updateDb("DELETE  FROM lycee WHERE idLycee = $idLycee",$this ->data);
      return $res;

   }

   


}



?>