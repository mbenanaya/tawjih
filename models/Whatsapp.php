<?php

include 'db.php';

class Whatsapp
{
	private $db;

	public function __construct()
	{
		$this->db = new Db;
	}

	public function getWhatsappData()
    {
        $sql = "SELECT * FROM whatsapp";
        $result = $this->db->executeQuery($sql);
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function updateWhatsappData($number, $message)
    {
        $sql = "UPDATE whatsapp SET numWhatsapp = '$number', messageWhatsapp = '$message'";
        $result = $this->db->executeQuery($sql);
        if ($result) {
        	return true;
        } else {
        	return false;
        }
    }
}
