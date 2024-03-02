<?php

require_once 'db.php';

class SendNotifications
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getPacks()
    {
    	$sql = "SELECT idPack, domaineP FROM packs WHERE active = 1";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getFilieres()
    {
    	$sql = "SELECT idBac, sectorFR FROM bac";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function getStudentsByPack($id_pack)
    {
    	$sql = "
    		SELECT students.id_student AS 'idStud',
			   students.codeMassar AS 'cne',
		       students.cin AS 'cin',
		       students.firstName AS 'prenom',
		       students.lastName AS 'nom',
               students.idBac AS 'idBac',
		       bac.sectorFR AS 'filiere',
		       packs.domaineP AS 'pack'
			FROM bac
			INNER JOIN students
		    	ON  bac.idBac = students.idBac
		    INNER JOIN packs
		    	ON students.id_pack = packs.idPack
            WHERE students.id_pack = $id_pack
    	";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getStudentsByFiliere($id_bac)
    {
        $sql = "
            SELECT students.id_student AS 'idStud',
               students.codeMassar AS 'cne',
               students.cin AS 'cin',
               students.firstName AS 'prenom',
               students.lastName AS 'nom',
               students.idBac AS 'idBac',
               bac.sectorFR AS 'filiere',
               packs.domaineP AS 'pack'
            FROM bac
            INNER JOIN students
                ON  bac.idBac = students.idBac
            INNER JOIN packs
                ON students.id_pack = packs.idPack
            WHERE students.idBac = $id_bac
        ";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getStudentsByFiliereAndPack($id_bac, $id_pack)
    {
        $sql = "
            SELECT students.id_student AS 'idStud',
               students.codeMassar AS 'cne',
               students.cin AS 'cin',
               students.firstName AS 'prenom',
               students.lastName AS 'nom',
               students.idBac AS 'idBac',
               bac.sectorFR AS 'filiere',
               packs.domaineP AS 'pack'
            FROM bac
            INNER JOIN students
                ON  bac.idBac = students.idBac
            INNER JOIN packs
                ON students.id_pack = packs.idPack
            WHERE students.idBac = $id_bac
            AND students.id_pack = $id_pack
        ";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getStudentIdByFiliere($idBac)
    {
        $sql = "SELECT id_student FROM students WHERE idBac = $idBac";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}
$s = new SendNotifications;
// var_dump($s->getStudentsByPack(5));