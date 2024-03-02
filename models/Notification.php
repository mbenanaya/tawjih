<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../models/db.php';
include '../boostrap.php';
require '../controllers/includes/Exception.php';
require '../controllers/includes/PHPMailer.php';
require '../controllers/includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Notification
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function createNotification($notif_subject, $notif_text, $id_student, $created_at)
    {
        
        $sql = "INSERT INTO notification(notif_subject, notif_text, id_student, created_at) VALUES ('$notif_subject', '$notif_text', '$id_student', '$created_at')";
        $result = $this->db->executeQuery($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function createNewArticleNotif($notif_subject, $notif_text, $titre, $bacs, $created_at)
    {
        $students_ids = $this->test($bacs);

        $id = $this->db->selectDb("SELECT id FROM article WHERE titre_article = '$titre'");
        $id = $id->fetchColumn();
        $sql = "INSERT INTO notification(notif_subject, notif_text, id, id_student, created_at) VALUES ('$notif_subject', '$notif_text', '$id', '$students_ids', '$created_at')";
        $result = $this->db->executeQuery($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    public function createUpdateArticleNotif($notif_subject, $notif_text, $id, $created_at)
    {
        $article = $this->getArticleData($id);
        $bacs = $article['bacs'];
        $students_ids = $this->test($bacs);

        $sql = "INSERT INTO notification(notif_subject, notif_text, id, id_student, created_at) VALUES ('$notif_subject', '$notif_text', '$id', '$students_ids', '$created_at')";
        $result = $this->db->executeQuery($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function countNewNotifications($student_id)
    {
        $sql = "SELECT * FROM notification WHERE FIND_IN_SET('$student_id', id_student) > 0 AND FIND_IN_SET('$student_id', read_status) = 0";
        $result = $this->db->executeQuery($sql);
        $count = $result->rowCount();
        return $count;
    }

    public function getAllNotifications($student_id)
    {
        $sql = "SELECT * FROM notification WHERE FIND_IN_SET('$student_id', id_student) > 0 ORDER BY id_notif DESC";
        $result = $this->db->executeQuery($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getArticleData($id)
    {
        $sql = "SELECT id, bacs FROM article WHERE id = $id";
        $result = $this->db->executeQuery($sql);
        $article = $result->fetch(PDO::FETCH_ASSOC);
        return $article;
    }

    public function getArticleTitle($titre)
    {
        $sql = "SELECT id, titre_article FROM article WHERE titre_article = '$titre'";
        $result = $this->db->executeQuery($sql);
        $article = $result->fetch(PDO::FETCH_ASSOC);
        return $article;
    }

    public function getStudsIdsByBac($bacs)
    {
        $bacs = array_map('strval', $bacs);
        $bacs = implode(',', $bacs);

        $sql    = "SELECT id_student FROM students WHERE FIND_IN_SET(idBac, '$bacs') > 0";
        $result = $this->db->executeQuery($sql);
        $data   = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function test($bacs)
    {
        $bacs = explode(",", $bacs);
        $studentIds = $this->getStudsIdsByBac($bacs);
        $studentIds = array_column($studentIds, 'id_student');
        $studentIds = array_map('strval', $studentIds);
        $groupedIds = implode(",", $studentIds);

        return $groupedIds;
    }

    public function getEmails($students_ids)
    {
        $sql = "SELECT email FROM students WHERE FIND_IN_SET(id_student, '$students_ids') > 0";
        $result = $this->db->executeQuery($sql);
        $emails = $result->fetchAll(PDO::FETCH_ASSOC);
        return $emails;
    }

    public function sendNewArticleEmail($emailSubject, $bacs, $titre)
    {
        $website      = $this->db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);
        $students_ids = $this->test($bacs);
        $emails       = $this->getEmails($students_ids);
        $article      = $this->getArticleTitle($titre);

        $id = $article['id'];
        $titre_article = $article['titre_article'];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $website->email;
            $mail->Password = $website->smtp_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = "UTF-8";
            $mail->setFrom($website->email,$website->siteWeb);
            
            foreach ($emails as $email) {
                $mail->addBCC($email['email']);
            }

            $articleLink = BASE_URL . "/article-concours?id=".$id;
            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = "
                <div dir='rtl' style='padding-right: 20px'>
                    <h3><b>تم الاعلان عن $titre_article</b></h3>
                    <p>لمعرفة التفاصيل اضغط على الرابط التالي:</p>
                    <h4><a href='".$articleLink."'> $articleLink</a>  </h4>
                </div>   
            ";

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendUpdateArticleEmail($emailSubject, $id)
    {
        $website = $this->db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);
        $sql = "SELECT titre_article, bacs FROM article WHERE id = $id";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $titre_article = $data['titre_article'];
        $bacs = $data['bacs'];
        $students_ids = $this->test($bacs);
        $emails       = $this->getEmails($students_ids);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $website->email;
            $mail->Password = $website->smtp_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = "UTF-8";
            $mail->setFrom($website->email,$website->siteWeb);
            
            foreach ($emails as $email) {
                $mail->addBCC($email['email']);
            }

            $articleLink = BASE_URL . "/article-concours?id=".$id;
            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = "
                <div dir='rtl' style='padding-right: 20px'>
                    <h3><b>هناك تحديث بخصوص $titre_article</b></h3>
                    <p>لمعرفة التفاصيل اضغط على الرابط التالي:</p>
                    <h4> <a href='".$articleLink."'>$articleLink</a> </h4> 
                </div>   
            ";

            if ($mail->send()) {
                return true;
            } else {
                return false;
        }
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendNewEmail($emailSubject, $text, $students_ids)
    {
        $website = $this->db->selectDb("SELECT * FROM website")->fetch(PDO::FETCH_OBJ);
        $emails = $this->getEmails($students_ids);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $website->email;
            $mail->Password = $website->smtp_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = "UTF-8";
            $mail->setFrom($website->email,$website->siteWeb);
            
            foreach ($emails as $email) {
                $mail->addBCC($email['email']);
            }

            $link = BASE_URL . "/dashboard-student";
            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = "
                <div dir='rtl' style='padding-right: 20px'>
                    <p>$text</p>
                    <p>لمعرفة التفاصيل اضغط على الرابط التالي:</p>
                    <h4> <a href='".$link."'> $link</a> </h4>
                </div> 
            ";

            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
        
    }

    public function getNotificationById($id_notif)
    {
        $sql = "SELECT * FROM notification WHERE id_notif = $id_notif";
        $result = $this->db->executeQuery($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function updateReadStatus($id_notif, $student_id)
    {
        $notification = $this->getNotificationById($id_notif);
        $read_status = $notification['read_status'];

        if (empty($read_status) || !in_array($student_id, explode(',', $read_status))) {
            if (empty($read_status)) {
                $updated_read_status = $student_id;
            } else {
                $updated_read_status = $read_status . ',' . $student_id;
            }

            $sql = "UPDATE notification SET read_status = '$updated_read_status' WHERE id_notif = '$id_notif'";
            $result = $this->db->executeQuery($sql);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

}
