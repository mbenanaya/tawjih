<?php 

include "../boostrap.php";
session_start();

unset($_SESSION['RESPONSABLEINFO']);
header('Location: '.BASE_URL.'/login-responsable');



?>