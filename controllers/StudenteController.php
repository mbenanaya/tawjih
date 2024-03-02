<?php


class StudenteController{
   
   public $data = 'tawjih';

   public function selectAllStudents(){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM students",$this->data);
      return $res;
   }

   public function insertStudent(
         $codeMassar, $cin, $email, 
         $firstName, $lastName, $firstNameArabe, 
         $lastNameArabe, $photo, $sex, $phone, 
         $parentPhone, $address, $placeBirth, 
         $dateBirth, $idBac, $idLycee, $idCity, $idRegion
   ){
      $db = new Db();
      $res = $db -> updateProcedure("insertStudent(
         '$codeMassar', '$cin', '$email', 
         '$firstName', '$lastName', '$firstNameArabe', 
         '$lastNameArabe', '$photo', '$sex', '$phone', 
         '$parentPhone', '$address', '$placeBirth', 
         $dateBirth, $idBac, $idLycee, $idCity, $idRegion
      )",$this->data);
      return $res;
   }

   public function showStudent($cin){
      $db = new Db();
      $res = $db->selectDb("SELECT * FROM  students WHERE cin  = $cin",$this->data);
      return $res;
   }

   public function updateRegion(
      $codeMassar, $cin, $email, 
      $firstName, $lastName, $firstNameArabe, 
      $lastNameArabe, $photo, $sex, $phone, 
      $parentPhone, $address, $placeBirth, 
      $dateBirth, $idBac, $idLycee, $idCity, $idRegion
   ){
      $db = new Db();
      $res = $db->updateProcedure("updateStudent(
         $codeMassar, $cin, $email, 
         $firstName, $lastName, $firstNameArabe, 
         $lastNameArabe, $photo, $sex, $phone, 
         $parentPhone, $address, $placeBirth, 
         $dateBirth, $idBac, $idLycee, $idCity, $idRegion
      ) ",$this->data);
      return $res;
   }

   public function deleteStudent($cin)
   {

      $db = new Db();
      $res = $db -> updateDb("DELETE  FROM students WHERE  cin  = $cin",$this ->data);
      return $res;

   }

   
}



?>