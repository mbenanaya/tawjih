<?php
/* session_start(); */
if (isset($_SESSION['email_student']) && isset($_SESSION['password_student']) && isset($_SESSION['unique_id_student'])) {
    $email_student = $_SESSION['email_student'];
    $password_student = $_SESSION['password_student'];
    $unique_id_student = $_SESSION['unique_id_student'];
    $bac = $_SESSION['idBac'];
} else {
    header('Location:'. BASE_URL .'/se-connecter');
}
?>