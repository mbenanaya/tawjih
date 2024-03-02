<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/Notification.php';
require_once '../models/SendNotifications.php';

class SendNotifController
{
	private $notification;
    private $sendNotif;
    private $currentTime;

    public function __construct()
    {
        $this->notification = new Notification;
        $this->sendNotif = new SendNotifications;
        $this->currentTime = date('Y-m-d_H:i:s');
    }

    public function getPacks()
    {
        $packs = $this->sendNotif->getPacks();

        $output = '';
        if (!empty($packs)) {
            $output .= '
                <label for="packs_select" class="form-label fw-bold">Selectionner par pack</label>
                <select id="pack" name="pack" class="form-select">
                    <option selected disabled>Choisir un pack</option>';
            foreach ($packs as $pack) {
                $output .= '<option value="' . $pack['idPack'] . '">' . $pack['domaineP'] . '</option>';
            }
            $output .= '</select>';
        } else {
            $output .= '';
        }

        header('Content-Type: text/html');
        echo $output;
    }


    public function getFilieres()
    {
        $filieres = $this->sendNotif->getFilieres();

        $output = '';
        if (!empty($filieres)) {
            $output .= '
                <label for="filieres" class="form-label fw-bold">Selectionner par filière</label>
                <select id="filieres" name="filieres" class="form-select">
                    <option selected disabled>Choisir filière</option>
            ';
            foreach ($filieres as $filiere) {
                $output .= '<option value="' . $filiere['idBac'] . '">' . $filiere['sectorFR'] . '</option>';
            }
            $output .= '</select>';
        } else {
            $output .= '';
        }

        header('Content-Type: text/html');
        echo $output;
    }

    public function getStudentsByPack($id_pack)
    {
        $studs = $this->sendNotif->getStudentsByPack($id_pack);

        $output = '';
        if (!empty($studs)) {
            $output .= '
                <table class="table table-responsive table-borderless table-striped-columns table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="d-flex justify-content-center">
                                <label class="m-0">
                                    <input type="checkbox" class="form-check-input" id="select_all" checked name="">
                                    <label for="select_all" class="form-check-label">Tous</label>
                                </label>
                            </th>
                            <th scope="col">CNE</th>
                            <th scope="col">CIN</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Filiere</th>
                            <th scope="col">Pack</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($studs as $stud) {
                $output .= '
                    <tr>
                        <td class="d-flex justify-content-center">
                            <input type="checkbox" value="'.$stud['idStud'].'" name="stud[]" class="form-check-input" checked>
                        </td>
                        <td>' . $stud['cne']     . '</td>
                        <td>' . $stud['cin']     . '</td>
                        <td>' . $stud['prenom']  . '</td>
                        <td>' . $stud['nom']     . '</td>
                        <td>' . $stud['filiere'] . '</td>
                        <td>' . $stud['pack']    . '</td>
                    </tr>
                ';
            }

            $output .= '</tbody> </table>';
            $output .= '';
        } else {
            $output .= '<h4 class="text-center">Pas d\'étudiants</h4>';
        }

        echo $output;
    }

    public function getStudentsByFiliere($filiere)
    {
        $studs = $this->sendNotif->getStudentsByFiliere($filiere);

        $output = '';
        if (!empty($studs)) {
            $output .= '
                <table class="table table-responsive table-borderless table-striped-columns table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="d-flex justify-content-center">
                                <label class="m-0">
                                    <input type="checkbox" class="form-check-input" id="select_all" checked name="">
                                    <label for="select_all" class="form-check-label">Tous</label>
                                </label>
                            </th>
                            <th scope="col">CNE</th>
                            <th scope="col">CIN</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Filiere</th>
                            <th scope="col">Pack</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($studs as $stud) {
                $output .= '
                    <tr>
                        <td class="d-flex justify-content-center">
                            <input type="checkbox" value="'.$stud['idStud'].'" name="stud[]" class="form-check-input" checked>
                        </td>
                        <td>' . $stud['cne']     . '</td>
                        <td>' . $stud['cin']     . '</td>
                        <td>' . $stud['prenom']  . '</td>
                        <td>' . $stud['nom']     . '</td>
                        <td>' . $stud['filiere'] . '</td>
                        <td>' . $stud['pack']    . '</td>
                    </tr>
                ';
            }

            $output .= '</tbody> </table>';
            $output .= '';
        } else {
            $output .= '<h4 class="text-center">Pas d\'étudiants</h4>';
        }

        echo $output;
    }

    public function getStudentsByFiliereAndPack($filiere, $pack)
    {
        $studs = $this->sendNotif->getStudentsByFiliereAndPack($filiere, $pack);

        $output = '';
        if (!empty($studs)) {
            $output .= '
                <table class="table table-responsive table-borderless table-striped-columns table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="d-flex justify-content-center">
                                <label class="m-0">
                                    <input type="checkbox" class="form-check-input" id="select_all" checked name="">
                                    <label for="select_all" class="form-check-label">Tous</label>
                                </label>
                            </th>
                            <th scope="col">CNE</th>
                            <th scope="col">CIN</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Filiere</th>
                            <th scope="col">Pack</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($studs as $stud) {
                $output .= '
                    <tr>
                        <td class="d-flex justify-content-center">
                            <input type="checkbox" value="'.$stud['idStud'].'" name="stud[]" class="form-check-input" checked>
                        </td>
                        <td>' . $stud['cne']     . '</td>
                        <td>' . $stud['cin']     . '</td>
                        <td>' . $stud['prenom']  . '</td>
                        <td>' . $stud['nom']     . '</td>
                        <td>' . $stud['filiere'] . '</td>
                        <td>' . $stud['pack']    . '</td>
                    </tr>
                ';
            }

            $output .= '</tbody> </table>';
            $output .= '';
        } else {
            $output .= '<h4 class="text-center">Pas d\'étudiants</h4>';
        }

        echo $output;
    }

    public function sendNotifAndEmail($studs_ids, $sujet, $text)
    {
        $sendNotif = $this->notification->createNotification($sujet, $text, $studs_ids, $this->currentTime);

        $sendEmail = $this->notification->sendNewEmail($sujet, $text, $studs_ids);

        $response = [];
        if ($sendNotif && $sendEmail) {
            $response = [
                'icon' => 'success',
                'success' => 'Envoye',
                'message' => 'Notification et email Envoye'
            ];
        } else if (!$sendNotif && $sendEmail) {
            $response = [
                'icon' => 'warning',
                'warning' => 'Attention',
                'message' => 'Notification n\'est pas Envoye'
            ];
        } else if ($sendNotif && !$sendEmail) {
            $response = [
                'icon' => 'warning',
                'warning' => 'Attention',
                'message' => 'Email n\'est pas Envoye'
            ];
        } else if (!$sendNotif && !$sendEmail) {
            $response = [
                'icon' => 'error',
                'error' => 'Erreur',
                'message' => 'Notification et email sont pas Envoye'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


}

$s = new SendNotifController;

if (isset($_POST['action']) && $_POST['action'] == 'getPacks') {
    $s->getPacks();
}

if (isset($_POST['action']) && $_POST['action'] == 'getFilieres') {
    $s->getFilieres();
}

if (isset($_POST['filiere']) && isset($_POST['pack'])) {
    $filiere = $_POST['filiere'];
    $pack = $_POST['pack'];
    $s->getStudentsByFiliereAndPack($filiere, $pack);
} else if (isset($_POST['pack'])) {
    $pack = $_POST['pack'];
    $s->getStudentsByPack($pack);
} else if (isset($_POST['filiere'])) {
    $filiere = $_POST['filiere'];
    $s->getStudentsByFiliere($filiere);
}

if (isset($_POST['studs'])) {
    $studs = implode(',', $_POST['studs']);
    $sujet = $_POST['sujet'];
    $text  = $_POST['notif_text'];
    $s->sendNotifAndEmail($studs, $sujet, $text);
}
