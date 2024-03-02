<?php

include "../models/Admin.php";

$admin = new Admin;

if (isset($_POST['adm_login'])) {

    $email = htmlspecialchars(stripcslashes(trim($_POST['email'])));
    $password = htmlspecialchars(stripcslashes(trim($_POST['password'])));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    $row = $admin->adminLogin($email, $password);


    header('Content-Type: application/json');
    if ($row) {
    	session_start();
        $_SESSION['adminInfo'] = $row;
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['id_admin'] = $row['id_admin'];

        $_SESSION['email_admin'] = $row['email'];
        $_SESSION['password_admin'] = $row['password'];
        $_SESSION['photo_admin'] = $row['photo'];

        $url = 'dashboard-admin';
        $response = array(
            'success' => true,
            'url' => $url,
        );
    } else {
        $response = array(
            'success' => false,
            'message' => "البريد الالكتروني أو كلمة السر غير صحيح"
        );
    }
    
    echo json_encode($response);

}
