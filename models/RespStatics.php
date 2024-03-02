
<?php

require_once '../models/db.php';

class RespStatics
{
	private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getStudentsCount($id)
    {
        $sql = "SELECT * FROM students WHERE id_responsable = $id";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getConcoursCount()
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->executeQuery($sql);
        $concoursCount = $result->rowCount();
        return $concoursCount;
    }

    // Get today's count
    public function getTodaysStudentsCount($id) {
        $sql = " SELECT * FROM students WHERE id_responsable = $id AND DATE(created_at) = CURDATE() ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getTodaysConcoursCount() {
        $sql = " SELECT * FROM article WHERE DATE(created_at) = CURDATE() ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    // Get count by day
    public function getStudentsCountByDay($id, $date) {
        $sql = " SELECT * FROM students WHERE id_responsable = $id AND DATE(created_at) = '$date' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getConcoursCountByDay($date) {
        $sql = " SELECT * FROM article WHERE DATE(created_at) = '$date' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getStudentsCountByDuration($id, $dateDb, $dateFin) {
        $sql = " SELECT * FROM students WHERE id_responsable = $id AND DATE(created_at) BETWEEN '$datedb' AND '$dateFin' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getConcoursCountByDuration($dateDb, $dateFin) {
        $sql = " SELECT * FROM article WHERE DATE(created_at) BETWEEN '$dateDb' AND '$dateFin' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getStudentsCountByPack($respId) {
        $sql = "
            SELECT COALESCE(COUNT(students.id_student), 0) AS studsNumber,
            packs.idPack AS idpack,
            packs.domaineP AS pack,
            packs.color AS color
            FROM packs
            LEFT JOIN students ON students.id_pack = packs.idPack AND students.id_responsable = $respId
            WHERE packs.active = 1
            GROUP BY packs.idPack;
        ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        return $studsCount;
    }

    public function getTodaysPacksStudentsCount($respId)
    {

        $sql = "
            SELECT packs.idPack AS idpack,
            COALESCE(COUNT(students.id_student), 0) AS todayStudsNumber
            FROM packs
            LEFT JOIN students ON students.id_pack = packs.idPack
            AND DATE(students.created_at) = CURDATE()
            AND students.id_responsable = $respId
            WHERE packs.active = 1
            GROUP BY packs.idPack;
        ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        return $studsCount;
    }

    public function getPacksStudsNumByDuration($respId, $dateDb, $dateFin)
    {
        $sql = "
            SELECT COALESCE(COUNT(students.id_student), 0) AS studsNumber,
            packs.idPack AS idpack,
            packs.domaineP AS pack,
            packs.color AS color
            FROM packs
            LEFT JOIN students ON students.id_pack = packs.idPack AND DATE(students.created_at) BETWEEN '$dateDb' AND '$dateFin' AND students.id_responsable = $respId
            WHERE packs.active = 1
            GROUP BY packs.idPack;
        ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        return $studsCount;
    }

}
