<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/db.php';

class Admin
{

    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function adminLogin($email, $password)
    {
        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        
        $result = $this->db->executeQuery($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;

    }

}
