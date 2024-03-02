<?php

require_once '../models/db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

class ArticleEtr
{
	private $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    public function addArticle($titre, $description_article, $lien, $image_name, $pdf_name, $audio_name, $video_name, $id_pays)
    {
        $sql = "INSERT INTO article_etr(titre, description_article, lien, image, pdf, audio, video, id_pays, created_at) VALUES(:titre, :description_article, :lien, :image, :pdf, :audio, :video, :id_pays, CURRENT_TIMESTAMP)";
            $params = [
                'titre' => $titre,
                'description_article' => $description_article,
                'lien' => $lien,
                'image' => $image_name,
                'pdf' => $pdf_name,
                'audio' => $audio_name,
                'video' => $video_name,
                'id_pays' => $id_pays,
            ];
            $result = $this->db->executeQuery($sql, $params);
            if ($result) {
                return true;
            } else {
                return false;
            }
    }

    public function getAllArticles()
    {
        $sql = "SELECT article_etr.*, pays.nomPaysFr FROM article_etr, pays WHERE article_etr.id_pays = pays.idPays";
        $result = $this->db->executeQuery($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getArticlesByCountry($idPays)
    {
        $sql = "SELECT article_etr.*, pays.nomPaysFr, pays.imagePays AS PaysImg FROM article_etr JOIN pays ON article_etr.id_pays = pays.idPays WHERE pays.idPays = $idPays";
        $result = $this->db->executeQuery($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getarticlesNumber()
    {
        $sql = "SELECT * FROM article_etr";
        $result = $this->db->executeQuery($sql);
        $count = $result->rowCount();
        return $count;
    }

    public function getArticleById($id)
    {
        $sql = "SELECT * FROM article_etr WHERE id = $id";
        $result = $this->db->executeQuery($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function updateArticle($id, $titre, $description_article, $lien, $image, $pdf, $audio, $video)
    {
        $sql = "UPDATE article_etr SET titre = '$titre', description_article = '$description_article', lien =  '$lien', image = '$image', pdf = '$pdf', audio = '$audio', video = '$video' WHERE id = $id";
        $result = $this->db->executeQuery($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteArticle($id)
    {
        $sql = "DELETE FROM article_etr WHERE id = :id";
        $result = $this->db->executeQuery($sql, ['id' => $id]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
