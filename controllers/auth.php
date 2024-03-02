<?php

    require __DIR__ . '/../models/db.php';

    class Auth extends Db{

        private $db;

        public function __construct()
        {
            $this->db = new Db();
        }

        /* public function add_article($title , $image){
            $sql = "INSERT INTO article (titre_article ,image) VALUES (:titre_article ,:image)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['titre_article'=>$title,'image'=>$image]);
            return true;             
        } */
        public function Showbac(){
            $sql = "SELECT * FROM bac";
            $result = $this->db->executeQuery($sql);
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            return $rows; 
        } 


        public function add_concours($titre,$image,$title , $pdf , $audio ,$video ,$temps ,$des, $ecole,$lien_video, $bacs){
            $sql = "INSERT INTO article (titre_article,image,titre_concours ,pdf ,audio ,video ,date_concours,description,lien_ecole,lien_video,bacs,created_at)VALUES(:titre_article,:image,:titre_concours ,:pdf ,:audio ,:video,:date_concours,:description,:lien_ecole,:lien_video, :bacs, CURDATE())";
            $this->db->executeQuery($sql, [
                'titre_article'=>$titre,
                'image'=>$image,
                'titre_concours'=>$title,
                'pdf'=>$pdf,
                'audio'=>$audio,
                'video'=>$video,
                'date_concours'=>$temps,
                'description'=>$des,
                'lien_ecole'=>$ecole,
                'lien_video'=>$lien_video,
                'bacs'=>$bacs
            ]);
            return true;
        }

        public function add_notification($notif_subject, $notif_text)
        {
            // $stmt = "INSERT INTO notification(notif_subject, notif_text) VALUES (:notif_subject, :notif_text)";
            // $stmt = $this->conn->prepare($sql);
            // $stmt->execute([
            //     'notif_subject'=>$notif_subject,
            //     'notif_text'=>$notif_text
            // ]);
            // return true;

            // $query = "INSERT INTO notification(notif_subject, notif_text) VALUES (:notif_subject, :notif_text)";
            // $stmt = $pdo->prepare($query);
            // $stmt->bindParam(':notif_subject', $notif_subject);
            // $stmt->bindParam(':notif_text', $notif_text);
            // if ($stmt->execute()) {
            //     return true;
            // } else {
            //     return false;
            // }

        }

        public function get_students(){
            $sql = "SELECT * FROM students ORDER BY created_at DESC";
            $result = $this->db->executeQuery($sql);
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        public function get_students_responsable($idResponsable){
            $sql = "SELECT * FROM students WHERE id_responsable = :id_responsable";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_responsable', $idResponsable, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        

        public function delete_student($code){
            $sql ="DELETE FROM students WHERE codeMassar= :codeMassar";
            $this->db->executeQuery($sql, ['codeMassar'=>$code]);
            return true;
        }

        public function info_student($code){
            $sql ="SELECT * FROM students WHERE codeMassar=:codeMassar";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['codeMassar'=>$code]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        public function get_article(){
            $sql = "SELECT * FROM article order by id desc";
            $result = $this->db->executeQuery($sql);
            $res= $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function edit_article($id){
            $sql ="SELECT * FROM article WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }

       /*  public function update_article($titre ,$titrecon,$date,$des,$ecole ,$id){
            $sql= "UPDATE article SET titre_article =:titre_article,titre_concours=:titre_concours,date_concours=:date_concours,description=:description,lien_ecole=:lien_ecole  WHERE id =:id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
            'titre_article'=>$titre,
            'titre_concours'=>$titrecon,
            'date_concours'=>$date,
            'description'=>$des,
            'lien_ecole'=>$ecole,
            'id'=>$id]);
            return true;
        } */
        public function update_article($titre,$img, $titrecon,$pdf,$audio,$video, $date, $des, $ecole, $id) {
            $sql = "UPDATE article SET titre_article=:titre_article,image=:image, titre_concours=:titre_concours,pdf=:pdf,audio=:audio,video=:video,date_concours=:date_concours, description=:description, lien_ecole=:lien_ecole WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':titre_article', $titre);
            $stmt->bindParam(':image', $img);
            $stmt->bindParam(':titre_concours', $titrecon);
            $stmt->bindParam(':pdf', $pdf);
            $stmt->bindParam(':audio', $audio);
            $stmt->bindParam(':video', $video);
            $stmt->bindParam(':date_concours', $date);
            $stmt->bindParam(':description', $des);
            $stmt->bindParam(':lien_ecole', $ecole);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }

        public function selectarticle($id){
            $sql = "SELECT * FROM article where id =:id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;

        }
        
        public function delete_article($id){
            $sql ="DELETE FROM article WHERE id= :id";
            $this->db->executeQuery($sql, ['id'=>$id]);
            return true;
        } 
        public function prix_pack($code){
            $sql = "SELECT packs.prixPack , packs.domaineP
            FROM students
            JOIN packs ON students.id_pack = packs.idPack
            WHERE students.codeMassar =:codeMassar";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['codeMassar'=>$code]);
            $row= $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        // START PARTIE USERS
        public function getAllUsers(){
            $sql = "SELECT * FROM  admin";
            $stmt = $this->db->executeQuery($sql);
            return $stmt;
        }

        public function selctAdminActive(){
            $sql = "SELECT * FROM admin WHERE active = 1";
            $stmt = $this->db->executeQuery($sql);
            return $stmt;
        }

        public function EditUser($id){
            $sql = "SELECT * FROM  admin WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id'=>$id]);
            $res = $stmt->fetch(PDO::FETCH_OBJ);
            return $res;
        }

        public function EditUserRes($id){
            $sql = "SELECT * FROM  responsables WHERE idRes = :idRes";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':idRes'=>$id]);
            $res = $stmt->fetch(PDO::FETCH_OBJ);
            return $res;
        }


        // END PARTIE USERS

        
        

       
        
      
  
        
        

        public function add_new_student($code ,$id_student,$cin ,$email,$pass,$fn,$lsn,$fna,$lsna,$photo,$sex,$bacyear,$phone,$pp,$adresse,$pb,$dbi,$idBac,$idLycee,$City,$Region,$pack,$responsable){

            /* $sql = "INSERT INTO students (codeMassar , id_student,cin ,email,password,firstName,lastName,firstNameArabe,lastNameArabe,photo,sex,bacYear,phone,parentPhone,address,placeBirth,dateBirth,idBac,idLycee,idCity,idRegion,statut,id_pack,id_responsable) 
            VALUES (:codeMassar,:id_student,:cin ,:email,:password,:firstName,:lastName,:firstNameArabe,:lastNameArabe,:photo,:sex,:bacYear,:phone,:parentPhone,:address,:placeBirth,:dateBirth,:idBac,:idLycee,:idCity,:idRegion,:statut,:id_pack,:id_responsable)";
            $this->db->executeQuery($sql,
            ['codeMassar'=>$code , 
            'id_student'=>$id_student,
            'cin'=>$cin, 
            'email'=>$email,
            'password'=>$pass,
            'firstName'=>$fn,
            'lastName'=>$lsn,
            'firstNameArabe'=>$fna,
            'lastNameArabe'=>$lsna,
            'photo'=>$photo,
            'sex'=>$sex,
            'bacYear'=>$bacyear,
            'phone'=>$phone,
            'parentPhone'=>$pp,
            'address'=>$adresse,
            'placeBirth'=>$pb,
            'dateBirth'=>$dbi,
            'idBac'=>$idBac,
            'idLycee'=>$idLycee,
            'idCity'=>$City,
            'idRegion'=>$Region,
            'statut'=>2,
            'id_pack'=>$pack,
            'id_responsable'=>$responsable,            
            ]); */            
            $res = $this->db->updateDb("INSERT INTO students (codeMassar , id_student,cin ,email,password,firstName,lastName,firstNameArabe,lastNameArabe,photo,sex,bacYear,phone,parentPhone,address,placeBirth,dateBirth,idBac,idLycee,idCity,idRegion,id_pack,id_responsable)
            VALUES ('$code',$id_student,'$cin','$email','$pass','$fn','$lsn','$fna','$lsna','$photo','$sex',$bacyear,'$phone','$pp','$adresse','$pb','$dbi',$idBac,$idLycee,$City,$Region,$pack,$responsable)");
            if($res > 0){               
                return true; 
            }else{
                return false;
            }                         
        }      

        public function Region(){
            $sql = "SELECT * FROM region";
            $result = $this->db->selectDb($sql);
            $res= $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function Ville(){
            $sql = "SELECT * FROM city ORDER BY name";
            $result = $this->db->selectDb($sql);
            $res= $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function Bac(){
            $sql = "SELECT * FROM bac ";
            $result = $this->db->selectDb($sql);
            $res= $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        public function Pack(){
            $sql = "SELECT * FROM packs";
            $result = $this->db->selectDb($sql);
            $res= $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        public function Responsables(){
            $sql = "SELECT * FROM responsables";
            $result = $this->db->selectDb($sql);
            $res= $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function Lycee(){
            $sql = "SELECT * FROM lycee";
            $result = $this->db->selectDb($sql);
            $res= $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function update_actdesact($id,$statut){
            if($statut == 1){
                $sql = "UPDATE students SET statut=2 WHERE codeMassar=:codeMassar";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':codeMassar', $id);                
                $stmt->execute();
                return true;
            }else{
                $sql = "UPDATE students SET statut=1 WHERE codeMassar=:codeMassar";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':codeMassar', $id);                
                $stmt->execute();
                return true;
            }          
        }

    public function website(){
        $sql = "SELECT * FROM website";
        $result = $this->db->selectDb($sql);
        $res= $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

}