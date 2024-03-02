<?php
include "../boostrap.php";
session_start();
unset($_SESSION['email_admin']);
unset($_SESSION['password_admin']);
unset($_SESSION['id_admin']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['photo_admin']);
unset($_SESSION['adminInfo']);
header('Location:'. BASE_URL .'/admin');
?>