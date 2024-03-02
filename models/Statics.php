<?php

require_once '../models/db.php';

class Statics
{
	private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getStudentsCount()
    {
        $sql = "SELECT * FROM students";
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
    public function getTodaysStudentsCount()
    {
        $sql = " SELECT * FROM students WHERE DATE(created_at) = CURDATE() ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getTodaysConcoursCount()
    {
        $sql = " SELECT * FROM article WHERE DATE(created_at) = CURDATE() ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    // Get count by day
    public function getStudentsCountByDay($date)
    {
        $sql = " SELECT * FROM students WHERE DATE(created_at) = '$date' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getConcoursCountByDay($date)
    {
        $sql = " SELECT * FROM article WHERE DATE(created_at) = '$date' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getStudentsCountByDuration($dateDb, $dateFin)
    {
        $sql = " SELECT * FROM students WHERE DATE(created_at) BETWEEN '$dateDb' AND '$dateFin' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }

    public function getConcoursCountByDuration($dateDb, $dateFin)
    {
        $sql = " SELECT * FROM article WHERE DATE(created_at) BETWEEN '$dateDb' AND '$dateFin' ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->rowCount();
        return $studsCount;
    }


    public function getStudentsCountByPack()
    {
        $sql = "
            SELECT packs.idPack AS idpack,
            COALESCE(COUNT(students.id_student), 0) AS studsNumber,
            packs.domaineP AS pack,
            packs.color AS color
            FROM packs
            LEFT JOIN students ON students.id_pack = packs.idPack
            WHERE packs.active = 1
            GROUP BY packs.idPack;
        ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        return $studsCount;
    }

    public function getTodaysPacksStudentsCount()
    {
        $sql = "
            SELECT packs.idPack AS idpack,
            COALESCE(COUNT(students.id_student), 0) AS todayStudsNumber
            FROM packs
            LEFT JOIN students ON students.id_pack = packs.idPack
            AND DATE(students.created_at) = CURDATE()
            WHERE packs.active = 1
            GROUP BY packs.idPack;
        ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        return $studsCount;
    }

    public function getPacksStudsNumByDuration($dateDb, $dateFin)
    {
        $sql = "
            SELECT packs.idPack AS idpack,
            COALESCE(COUNT(students.id_student), 0) AS studsNumber,
            packs.domaineP AS pack,
            packs.color AS color
            FROM packs
            LEFT JOIN students ON students.id_pack = packs.idPack AND DATE(students.created_at) BETWEEN '$dateDb' AND '$dateFin'
            WHERE packs.active = 1
            GROUP BY packs.idPack;
        ";
        $result = $this->db->executeQuery($sql);
        $studsCount = $result->fetchAll(PDO::FETCH_ASSOC);
        return $studsCount;
    }

}
