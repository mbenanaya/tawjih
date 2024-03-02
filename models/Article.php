<?php

require_once '../models/db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Article
{
	private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getAllArticles($idBac)
    {
        $sql = "SELECT id, titre_article, image, date_concours, bacs FROM article WHERE FIND_IN_SET('$idBac', bacs) > 0 ORDER BY id desc";
        $result = $this->db->executeQuery($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getArticle($id)
    {
        $sql = "SELECT titre_article, image, titre_concours, pdf, audio, video, description, lien_ecole, date_concours,DATE_FORMAT(created_at, '%d-%m-%Y') AS created_at,lien_video FROM article WHERE id = $id";
        $result = $this->db->executeQuery($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}
