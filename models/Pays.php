<?php

require_once '../models/db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Pays
{
	private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function addCountry($nomPays, $nomPaysFr, $imagePays, $description)
    {
        try {
            $sql = "INSERT INTO pays(nomPays, nomPaysFr, imagePays, description) VALUES(:nomPays, :nomPaysFr, :imagePays, :description)";
            $params = [
                'nomPays' => $nomPays,
                'nomPaysFr' => $nomPaysFr,
                'imagePays' => $imagePays,
                'description' => $description
            ];
            $result = $this->db->executeQuery($sql, $params);
            if ($result) {
                return 'added';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return 'already exist';
            } else {
                return 'database error';
            }
        }
    }


    public function getAllCountries()
    {
        $sql = "SELECT * FROM pays";
        $result = $this->db->executeQuery($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getCountriesNumber()
    {
        $sql = "SELECT * FROM pays";
        $result = $this->db->executeQuery($sql);
        $count = $result->rowCount();
        return $count;
    }

    public function getCountryById($idPays)
    {
        $sql = "SELECT * FROM pays WHERE idPays = $idPays";
        $result = $this->db->executeQuery($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function updateCountry($id, $nomPays, $nomPaysFr, $imagePays, $description)
    {
        $sql = "UPDATE pays SET nomPays = '$nomPays', nomPaysFr = '$nomPaysFr', imagePays =  '$imagePays', description = '$description' WHERE idPays = $id";
        $result = $this->db->executeQuery($sql);
        if ($result) {
            return true;
        }
    }

    public function deleteCountry($idPays)
    {
        $sql = "DELETE FROM pays WHERE idPays = :idPays";
        $result = $this->db->executeQuery($sql, ['idPays' => $idPays]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}