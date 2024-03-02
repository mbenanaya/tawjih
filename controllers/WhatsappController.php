<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/Whatsapp.php';

class WhatsappController
{
	private $whatsapp;

    public function __construct()
    {
        $this->whatsapp = new Whatsapp;
    }

    public function getWhatsappData()
    {
    	header('Content-Type: application/json');
        $result = $this->whatsapp->getWhatsappData();
        echo json_encode($result);
    }

    public function updateWhatsappData($number, $message)
    {
    	header('Content-Type: application/json');
        $result = $this->whatsapp->updateWhatsappData($number, $message);
        if ($result) {
        	$response = ['success'=> true, 'message' => 'updated'];
        } else {
        	$response = ['error'=> true, 'message' => 'not updated'];
        }

        echo json_encode($response);
    }
}

$w = new WhatsappController;

if (isset($_POST['action']) && $_POST['action'] == 'getData') {
	$w->getWhatsappData();
}
if (isset($_POST['action']) && $_POST['action'] == 'getWhatsData') {
	$w->getWhatsappData();
}

if (isset($_POST['saveWhatsappData'])) {
	$number = $_POST['numWhatsapp'];
	$message = $_POST['messageWhatsapp'];
	$w->updateWhatsappData($number, $message);
}