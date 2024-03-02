<?php

require_once '../models/RespStatics.php';

class RespStaticsController
{
	private $statics;

    public function __construct()
    {
        $this->statics = new RespStatics;
    }

    public function getStatics($respId)
    {
        $studsCount    = $this->statics->getStudentsCount($respId);
        $concoursCount = $this->statics->getConcoursCount();
        $data = [
        	'studsCount'    => $studsCount,
        	'concoursCount' => $concoursCount,
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getTodaysStatics($respId)
    {
        $studsTodayCount    = $this->statics->getTodaysStudentsCount($respId);
        $concoursTodayCount = $this->statics->getTodaysConcoursCount();
        $data = [
            'studsTodayCount'    => $studsTodayCount,
            'concoursTodayCount' => $concoursTodayCount,
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getStaticsByDay($respId, $date)
    {
        $studsCountByDay    = $this->statics->getStudentsCountByDay($respId, $date);
        $concoursCountByDay = $this->statics->getConcoursCountByDay($date);
        $data = [
            'studsCountByDay'    => $studsCountByDay,
            'concoursCountByDay' => $concoursCountByDay,
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getStaticsByDuration($respId, $dateDb, $dateFin)
    {
        $studsCountByDuration    = $this->statics->getStudentsCountByDuration($respId, $dateDb, $dateFin);
        $concoursCountByDuration = $this->statics->getConcoursCountByDuration($dateDb, $dateFin);
        $data = [
            'studsCountByDuration'    => $studsCountByDuration,
            'concoursCountByDuration' => $concoursCountByDuration,
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getStudentsCountByPack($respId) {
        $result = $this->statics->getStudentsCountByPack($respId);
        $todaysData = $this->statics->getTodaysPacksStudentsCount($respId);
        header("Content-Type: application/json");
        $data = ['result' => $result, 'todaysData' => $todaysData ];
        echo json_encode($data);
    }

    public function getPacksStudsNumByDuration($respId, $dateDb, $dateFin)
    {
        $data = $this->statics->getPacksStudsNumByDuration($respId, $dateDb, $dateFin);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

$st = new RespStaticsController;

if (isset($_POST['respId']) && isset($_POST['action']) && $_POST['action'] == 'getStatics') {
	$respId = $_POST['respId'];
	$st->getStatics($respId);
}


if (isset($_POST['respId']) && isset($_POST['action']) && $_POST['action'] == 'getTodaysStatics') {
	$respId = $_POST['respId'];
    $st->getTodaysStatics($respId);
}

// Filter by day
if (isset($_POST['filterByDay'])) {
	$respId = $_POST['respId'];
    $date = $_POST['datefil'];
    $st->getStaticsByDay($respId, $date);
}

// Filter by duration
if (isset($_POST['filterByDuration'])) {
	$respId  = $_POST['respId'];
    $datedb  = $_POST['datedb'];
    $datefin = $_POST['datefin'];
    $st->getStaticsByDuration($respId, $datedb, $datefin);
}

if (isset($_POST['respId']) && isset($_POST['action']) && $_POST['action'] == 'getStudentsCountByPack') {
	$respId = $_POST['respId'];
    $st->getStudentsCountByPack($respId);
}

// Filter Packs Students by duration
if (isset($_POST['filterPacksByDur'])) {
    $respId = $_POST['rid'];
    $datedb = $_POST['dateDbP'];
    $datefin = $_POST['dateFinp'];
    $st->getPacksStudsNumByDuration($respId, $datedb, $datefin);
}