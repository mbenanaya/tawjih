<?php

require_once '../models/Statics.php';

class StaticsController
{
	private $statics;

    public function __construct()
    {
        $this->statics = new Statics;
    }

    public function getStatics()
    {
        $studsCount    = $this->statics->getStudentsCount();
        $concoursCount = $this->statics->getConcoursCount();
        $data = [
        	'studsCount'    => $studsCount,
        	'concoursCount' => $concoursCount,

        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getTodaysStatics()
    {
        $studsTodayCount    = $this->statics->getTodaysStudentsCount();
        $concoursTodayCount = $this->statics->getTodaysConcoursCount();
        $data = [
            'studsTodayCount'    => $studsTodayCount,
            'concoursTodayCount' => $concoursTodayCount,
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getStaticsByDay($date)
    {
        $studsCountByDay    = $this->statics->getStudentsCountByDay($date);
        $concoursCountByDay = $this->statics->getConcoursCountByDay($date);
        $data = [
            'studsCountByDay'    => $studsCountByDay,
            'concoursCountByDay' => $concoursCountByDay,
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getStaticsByDuration($dateDb, $dateFin)
    {
        $studsCountByDuration    = $this->statics->getStudentsCountByDuration($dateDb, $dateFin);
        $concoursCountByDuration = $this->statics->getConcoursCountByDuration($dateDb, $dateFin);
        $data = [
            'studsCountByDuration'    => $studsCountByDuration,
            'concoursCountByDuration' => $concoursCountByDuration,
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getStudentsCountByPack(){
        $result = $this->statics->getStudentsCountByPack();
        $todaysData = $this->statics->getTodaysPacksStudentsCount();
        header("Content-Type: application/json");
        $data = ['result' => $result, 'todaysData' => $todaysData ];
        echo json_encode($data);
    }

    public function getPacksStudsNumByDuration($dateDb, $dateFin)
    {
        $data = $this->statics->getPacksStudsNumByDuration($dateDb, $dateFin);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

$st = new StaticsController;

if (isset($_POST['action']) && $_POST['action'] == 'getStatics') {
	$st->getStatics();
}


if (isset($_POST['action']) && $_POST['action'] == 'getTodaysStatics') {
    $st->getTodaysStatics();
}

// Filter by day
if (isset($_POST['filterByDay'])) {
    $date = $_POST['datefil'];
    $st->getStaticsByDay($date);
}

// Filter by duration
if (isset($_POST['filterByDuration'])) {
    $datedb = $_POST['datedb'];
    $datefin = $_POST['datefin'];
    $st->getStaticsByDuration($datedb, $datefin);
}

if (isset($_POST['action']) && $_POST['action'] == 'getStudentsCountByPack') {
    $st->getStudentsCountByPack();
}

// Filter Packs Students by duration
if (isset($_POST['filterPacksByDuration'])) {
    $datedb = $_POST['dateDbP'];
    $datefin = $_POST['dateFinp'];
    $st->getPacksStudsNumByDuration($datedb, $datefin);
}