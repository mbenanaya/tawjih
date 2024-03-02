<?php
/* session_start(); */
if (isset($_SESSION['email_admin']) && isset($_SESSION['password_admin']) && isset($_SESSION['id_admin'])) {
    $email_admin = $_SESSION['email_admin'];
    $password_admin = $_SESSION['password_admin'];
    $unique_id_admin = $_SESSION['id_admin'];
} else {
    header('Location:'. BASE_URL .'/admin');
}
?>