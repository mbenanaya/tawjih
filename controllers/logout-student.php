<?php
include "../boostrap.php";
session_start();
unset($_SESSION['email_student']);
unset($_SESSION['password_student']);
unset($_SESSION['unique_id_student']);
unset($_SESSION['firstName_student']);
unset($_SESSION['lastName_student']);
unset($_SESSION['photo_student']);
header('Location:'. BASE_URL .'/se-connecter');
?>